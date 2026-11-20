<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentsAsCode;

use ElevenLabs\AgentsAsCode\Agent;
use ElevenLabs\AgentsAsCode\AgentIssue;
use ElevenLabs\AgentsAsCode\AgentValidationError;
use ElevenLabs\AgentTools\Schema;
use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\AgentWorkflows\WorkflowValidationError;
use ElevenLabs\Types\ConversationalConfig;
use ElevenLabs\Types\Llm;
use ElevenLabs\Types\TurnConfig;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
  public const CLI_PROJECT = __DIR__ . '/../fixtures/agents_as_code/project/cli-graph';

  /** @return array<string, mixed> */
  public static function readJson(string $path): array
  {
    /** @var array<string, mixed> */
    return Wire::decodeJson((string) file_get_contents(self::CLI_PROJECT . '/' . $path));
  }

  public static function getOrder(string $description = 'Look up an order by its number'): Tool
  {
    return Tool::webhook('get_order', $description)
      ->get('https://api.example.com/orders/{order_id}')
      ->pathParam('order_id', Schema::string()->describe('The order number'));
  }

  public static function showOrder(): Tool
  {
    return Tool::client('show_order', 'Show the order card')
      ->param('order_id', Schema::string()->fromVariable('order_id'));
  }

  /** Canonical JSON text, so key order and `{}` vs `[]` are compared too. */
  public static function canon(mixed $value): string
  {
    return Wire::encode(Wire::canonical($value));
  }

  /**
   * @return list<array{string, ?string}>
   */
  private static function issuesOf(callable $fn): array
  {
    try {
      $fn();
    } catch (AgentValidationError $e) {
      return array_map(static fn(AgentIssue $i): array => [$i->code, $i->path], $e->issues);
    }
    self::fail('expected an AgentValidationError');
  }

  public function testMapsTypedOptionsToolsAndSystemToolsIntoTheApiConfig(): void
  {
    $agent = new Agent(
      'Support line',
      prompt: 'You are a support agent.',
      firstMessage: 'Hi!',
      language: 'en',
      llm: Llm::Gemini20Flash,
      temperature: 0.5,
      voiceId: 'voice_1',
      ttsModel: 'eleven_flash_v2_5',
      tags: ['support'],
      tools: [SystemTool::endCall(), self::getOrder()],
      toolIds: ['tool_existing'],
    );
    $config = $agent->toJson(['get_order' => 'tool_1']);
    $this->assertSame(self::canon([
      'conversation_config' => [
        'agent' => [
          'first_message' => 'Hi!',
          'language' => 'en',
          'prompt' => [
            'built_in_tools' => [
              'end_call' => ['name' => 'end_call', 'params' => ['system_tool_type' => 'end_call'], 'type' => 'system'],
            ],
            'llm' => 'gemini-2.0-flash',
            'prompt' => 'You are a support agent.',
            'temperature' => 0.5,
            'tool_ids' => ['tool_existing', 'tool_1'],
          ],
        ],
        'tts' => ['model_id' => 'eleven_flash_v2_5', 'voice_id' => 'voice_1'],
      ],
      'name' => 'Support line',
      'platform_settings' => new \stdClass(),
      'tags' => ['support'],
    ]), Wire::encode($config));
    // Already sorted.
    $this->assertSame(self::canon($config), Wire::encode($config));

    $body = $agent->build(['get_order' => 'tool_1']);
    $this->assertSame('Support line', $body->name);
    $this->assertSame(['tool_existing', 'tool_1'], $body->conversationConfig->agent->prompt->toolIds);
    $this->assertSame('You are a support agent.', $body->conversationConfig->agent->prompt->prompt);
    $this->assertSame('voice_1', $body->conversationConfig->tts?->voiceId);
  }

  public function testMergesTheRawConfigUnderTheTypedOptions(): void
  {
    $agent = new Agent(
      'A',
      prompt: 'p',
      conversationConfig: [
        'turn' => ['turn_timeout' => 7],
        'agent' => ['disable_first_message_interruptions' => true],
      ],
      platformSettings: ['privacy' => ['record_voice' => false]],
    );
    $agent->update(conversationConfig: new ConversationalConfig(['turn' => new TurnConfig(['silenceEndCallTimeout' => 20.0])]));
    $config = $agent->toJson();
    $this->assertSame(self::canon([
      'agent' => ['disable_first_message_interruptions' => true, 'prompt' => ['prompt' => 'p']],
      'turn' => ['silence_end_call_timeout' => 20, 'turn_timeout' => 7],
    ]), self::canon($config['conversation_config']));
    $this->assertSame(self::canon(['privacy' => ['record_voice' => false]]), self::canon($config['platform_settings']));
  }

  public function testFillsInTheIdsOfToolObjectsUsedByWorkflowNodes(): void
  {
    $lookup = self::getOrder();
    $show = self::showOrder();
    $wf = new Workflow();
    $wf->converse('triage', 'Find out what the caller needs')
      ->when('Caller gave an order number')
      ->tool('lookup', [$lookup], schemaOverrides: [
        'get_order' => ['path_params.order_id' => ['source' => 'constant', 'constant_value' => '1']],
      ])
      ->onSuccess()
      ->converse('resolve', 'Explain the order', toolIds: [$show, 'tool_raw']);
    $agent = new Agent('A', prompt: 'p', workflow: $wf);

    $this->assertSame([$lookup, $show], $agent->tools());
    $nodes = $agent->toJson(['get_order' => 'tool_g', 'show_order' => 'tool_s'])['workflow']['nodes'];
    $this->assertSame(self::canon([
      ['schema_overrides' => ['path_params.order_id' => ['constant_value' => '1', 'source' => 'constant']], 'tool_id' => 'tool_g'],
    ]), self::canon($nodes['lookup']['tools']));
    $this->assertSame(['tool_s', 'tool_raw'], $nodes['resolve']['additional_tool_ids']);
    $this->assertSame(
      [['unresolved_tool', 'tools.show_order']],
      self::issuesOf(fn() => $agent->toJson(['get_order' => 'tool_g'])),
    );
  }

  public function testValidatesWithoutIds(): void
  {
    (new Agent('A', prompt: 'p', tools: [self::getOrder()]))->validate();
    $this->addToAssertionCount(1);
  }

  public function testReportsEveryProblemAtOnce(): void
  {
    $wf = new Workflow();
    $wf->tool('hang_up', [SystemTool::endCall()]);
    $agent = new Agent(
      '',
      prompt: 'p',
      tools: [self::getOrder(), self::getOrder(), Tool::webhook('broken', 'No URL')],
      workflow: $wf,
      conversationConfig: ['agent' => ['prompt' => ['prompt' => 'raw prompt']]],
    );
    $this->assertSame([
      ['missing_name', null],
      ['option_conflict', 'conversation_config.agent.prompt.prompt'],
      ['duplicate_tool_name', 'tools.get_order'],
      ['invalid_tool', 'tools.broken'],
      ['system_tool_in_workflow', 'workflow.tools.end_call'],
    ], self::issuesOf(fn() => $agent->validate()));
  }

  public function testReportsARawConfigThatIsNotAnObject(): void
  {
    /** @phpstan-ignore-next-line A list on purpose: it isn't an object. */
    $agent = new Agent('A', prompt: 'p', conversationConfig: ['not', 'an', 'object']);
    $this->assertSame([['invalid_config', 'conversationConfig']], self::issuesOf(fn() => $agent->validate()));
  }

  public function testWarnsWithoutFailingWhenThereIsNoPrompt(): void
  {
    $warnings = [];
    (new Agent('A'))->validate(function (AgentIssue $issue) use (&$warnings): void {
      $warnings[] = $issue->code;
    });
    $this->assertSame(['missing_prompt'], $warnings);
  }

  public function testRoundTripsACliAgentConfigKeepingUnmodeledFieldsAndToolOrder(): void
  {
    $raw = self::readJson('agent_configs/support.json');
    $lookup = Tool::fromJson(self::readJson('tool_configs/lookup_order.json'));
    $agent = Agent::fromJson($raw, ['tool_lookup' => $lookup]);

    $this->assertSame('Support', $agent->name());
    $this->assertSame([$lookup], $agent->tools());
    $this->assertSame(['tool_from_dashboard'], $agent->toolIds());
    $this->assertSame(self::canon($raw), Wire::encode($agent->toJson(['lookup_order' => 'tool_lookup'])));
  }

  public function testRoundTripsTheFixtureAsAJsonString(): void
  {
    $text = (string) file_get_contents(self::CLI_PROJECT . '/agent_configs/support.json');
    $lookup = Tool::fromJson(self::readJson('tool_configs/lookup_order.json'));
    $agent = Agent::fromJson($text, ['tool_lookup' => $lookup]);
    $this->assertSame(self::canon(Wire::decodeJson($text)), Wire::encode($agent->toJson(['lookup_order' => 'tool_lookup'])));
  }

  public function testTurnsALoadedWorkflowIntoAWorkflowOnFirstUseWithToolIdsBound(): void
  {
    $raw = self::readJson('agent_configs/support.beta.json');
    $refund = Tool::fromJson(self::readJson('tool_configs/issue_refund.json'));
    $agent = Agent::fromJson($raw, ['tool_refund' => $refund]);

    $this->assertSame([$refund], $agent->tools()); // read from the raw workflow, before it's materialized
    $unedited = $agent->toJson(['issue_refund' => 'tool_refund']);
    $this->assertSame(self::canon($raw['workflow']), self::canon($unedited['workflow']));

    $agent->workflow()?->node('refunds')->update(prompt: 'Handle refunds');
    $nodes = $agent->toJson(['issue_refund' => 'tool_new'])['workflow']['nodes'];
    $this->assertSame(['tool_new'], $nodes['refunds']['additional_tool_ids']);
    $this->assertSame('Handle refunds', $nodes['refunds']['additional_prompt']);
  }

  public function testReplacesALoadedAgentsSystemToolsAlongWithItsOtherTools(): void
  {
    $agent = Agent::fromJson(self::readJson('agent_configs/support.json'));
    $this->assertSame([], $agent->tools()); // system tools aren't managed by push
    $agent->update(tools: []);
    $prompt = $agent->toJson()['conversation_config']['agent']['prompt'];
    $this->assertArrayNotHasKey('built_in_tools', $prompt);
    $this->assertSame(['tool_lookup', 'tool_from_dashboard'], $prompt['tool_ids']); // ids it doesn't manage stay
  }

  public function testTreatsAnExplicitlyEmptyToolListAsSet(): void
  {
    $agent = new Agent(
      'A',
      prompt: 'p',
      toolIds: [],
      conversationConfig: ['agent' => ['prompt' => ['tool_ids' => ['tool_existing']]]],
    );
    $this->assertSame([['option_conflict', 'conversation_config.agent.prompt.tool_ids']], self::issuesOf(fn() => $agent->validate()));
  }

  public function testValidatesALoadedWorkflowWithoutMaterializingIt(): void
  {
    $raw = self::readJson('agent_configs/support.beta.json');
    $raw['workflow']['edges']['broken'] = ['source' => 'start_node', 'target' => 'nowhere'];
    $agent = Agent::fromJson($raw);
    $this->assertSame([['invalid_workflow', 'workflow']], self::issuesOf(fn() => $agent->validate()));
  }

  public function testWritesNewToolIdsIntoALoadedWorkflowItHasNotMaterialized(): void
  {
    $raw = self::readJson('agent_configs/support.beta.json');
    $refund = Tool::fromJson(self::readJson('tool_configs/issue_refund.json'));
    $agent = Agent::fromJson($raw, ['tool_refund' => $refund]);
    $nodes = $agent->toJson(['issue_refund' => 'tool_clone'])['workflow']['nodes'];
    $this->assertSame(['tool_clone'], $nodes['refunds']['additional_tool_ids']);
  }

  public function testAttachesAToolAddedWithAddTool(): void
  {
    $agent = (new Agent('A', prompt: 'p'))->addTool(self::getOrder());
    $this->assertSame(['tool_1'], $agent->toJson(['get_order' => 'tool_1'])['conversation_config']['agent']['prompt']['tool_ids']);
  }

  public function testLetsARemovedNodesToolNameBeReusedByANewToolObject(): void
  {
    $wf = new Workflow();
    $wf->tool('a', [self::getOrder()]);
    $wf->remove('a');
    $wf->tool('b', [self::getOrder()]);
    $wf->build(toolIds: ['get_order' => 'tool_1']);
    $this->addToAssertionCount(1);
  }

  public function testReportsTwoDifferentToolsWithOneNameInTheSameNode(): void
  {
    $wf = new Workflow();
    $wf->tool('lookup', [self::getOrder(), self::getOrder()]);
    try {
      $wf->build(toolIds: ['get_order' => 'tool_1']);
      $this->fail('expected a WorkflowValidationError');
    } catch (WorkflowValidationError $e) {
      $this->assertSame(['duplicate_tool_name'], array_map(static fn($i) => $i->code, $e->issues));
    }

    $lookup = self::getOrder();
    $same = new Workflow();
    $same->tool('lookup', [$lookup, $lookup]);
    $same->build(toolIds: ['get_order' => 'tool_1']);
  }

  public function testWritesToolObjectsAsIdsInToJsonAndToJsonString(): void
  {
    $wf = new Workflow();
    $wf->tool('lookup', [self::getOrder()]);
    $toolIds = ['get_order' => 'tool_1'];
    $this->assertSame($wf->toJsonString($toolIds), Wire::encode($wf->toJson($toolIds)));
    $this->assertSame([['tool_id' => 'tool_1']], $wf->toJson($toolIds)['nodes']['lookup']['tools']);
    try {
      $wf->toJson();
      $this->fail('expected a WorkflowValidationError');
    } catch (WorkflowValidationError $e) {
      $this->assertSame(['unresolved_tool'], array_map(static fn($i) => $i->code, $e->issues));
    }
  }

  public function testSwapsKnownToolIdsForToolObjectsOnLoadAndKeepsUnknownIds(): void
  {
    $getOrder = Tool::client('get_order', 'Look up an order');
    $wf = new Workflow();
    $wf->converse('a', 'A', toolIds: ['tool_1', 'tool_other']);
    $json = $wf->toJson();

    $loaded = Workflow::fromJson($json, ['tool_1' => $getOrder]);
    $this->assertSame([$getOrder], $loaded->tools());
    $built = $loaded->toJsonString(['get_order' => 'tool_9']);
    $this->assertStringContainsString('tool_9', $built);
    $this->assertStringContainsString('tool_other', $built);
    $this->assertStringNotContainsString('"tool_1"', $built);
  }
  /** A workflow whose two nodes use two different tool ids. */
  private static function twoToolIdsWorkflow(): mixed
  {
    $wf = new Workflow();
    $wf->tool('a', ['tool_1'])->onSuccess()->tool('b', ['tool_2']);
    return $wf->toJson();
  }

  public function testReportsTwoLoadedToolIdsWhoseToolsShareANameInsteadOfMergingThem(): void
  {
    $first = Tool::client('get_order', 'First');
    $second = Tool::client('get_order', 'Second');
    $loaded = Workflow::fromJson(self::twoToolIdsWorkflow(), ['tool_1' => $first, 'tool_2' => $second]);
    try {
      $loaded->toJson(['get_order' => 'tool_9']);
      $this->fail('expected a WorkflowValidationError');
    } catch (WorkflowValidationError $e) {
      $this->assertSame(['duplicate_tool_name'], array_map(static fn($i) => $i->code, $e->issues));
    }
  }

  public function testReportsALoadedAgentsWorkflowToolsThatShareANameOnceTheWorkflowIsRead(): void
  {
    $first = Tool::client('get_order', 'First');
    $second = Tool::client('get_order', 'Second');
    $agent = Agent::fromJson(
      ['name' => 'A', 'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p']]], 'workflow' => self::twoToolIdsWorkflow()],
      ['tool_1' => $first, 'tool_2' => $second],
    );
    $this->assertNotNull($agent->workflow());
    try {
      $agent->validate();
      $this->fail('expected an AgentValidationError');
    } catch (AgentValidationError $e) {
      $this->assertStringContainsString('also named "get_order"', $e->getMessage());
    }
  }
  public function testAnEmptySettingsMergeLeavesALoadedAgentsSettingsAsTheyWere(): void
  {
    $config = [
      'name' => 'A',
      'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p']], 'future_setting' => ['on' => true]],
      'platform_settings' => ['widget' => ['variant' => 'compact']],
    ];
    $before = self::canon(Agent::fromJson($config)->toJson());
    foreach ([[], new ConversationalConfig([])] as $empty) {
      $agent = Agent::fromJson($config);
      $agent->update(conversationConfig: $empty, platformSettings: []);
      $this->assertSame($before, self::canon($agent->toJson()));
    }
  }
}
