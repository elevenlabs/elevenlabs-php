<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentsAsCode;

use ElevenLabs\AgentsAsCode\Agent;
use ElevenLabs\AgentsAsCode\AgentProject;
use ElevenLabs\AgentsAsCode\AgentPushError;
use ElevenLabs\AgentsAsCode\AgentsAsCode;
use ElevenLabs\AgentsAsCode\AgentValidationError;
use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\Exceptions\ElevenlabsApiException;
use PHPUnit\Framework\TestCase;

class PushTest extends TestCase
{
  /**
   * @param list<Tool>|null $tools
   */
  private static function supportAgent(?array $tools = null): Agent
  {
    $tools ??= [AgentTest::getOrder(), AgentTest::showOrder()];
    $wf = new Workflow();
    $wf->converse('triage', 'Find out what the caller needs')
      ->when('Caller gave an order number')
      ->tool('lookup', [$tools[0]])
      ->onSuccess()
      ->converse('resolve', 'Explain the order');
    return new Agent(
      'Support line',
      prompt: 'You help with orders.',
      tools: array_merge([SystemTool::endCall()], array_slice($tools, 1)),
      workflow: $wf,
    );
  }

  private static function agents(FakeServer $server): AgentsAsCode
  {
    return new AgentsAsCode($server->client());
  }

  /** @return array<string, mixed> */
  private static function json(string $text): array
  {
    /** @var array<string, mixed> */
    return json_decode($text, true, 512, JSON_THROW_ON_ERROR);
  }

  public function testCreatesTheToolsThenTheAgentWithTheirIds(): void
  {
    $server = new FakeServer();
    $result = self::agents($server)->push(self::supportAgent());

    $this->assertSame(['POST /v1/convai/tools', 'POST /v1/convai/tools', 'POST /v1/convai/agents/create'], $server->writes());
    $this->assertSame([
      'agentId' => 'agent_new_3',
      'action' => 'created',
      'tools' => [
        'show_order' => ['id' => 'tool_new_1', 'action' => 'created'],
        'get_order' => ['id' => 'tool_new_2', 'action' => 'created'],
      ],
    ], $result->toArray());
    $sent = $server->agents['agent_new_3'];
    $this->assertSame(['tool_new_1'], $sent['conversation_config']['agent']['prompt']['tool_ids']);
    $this->assertSame('end_call', $sent['conversation_config']['agent']['prompt']['built_in_tools']['end_call']['name']);
    $this->assertSame([['tool_id' => 'tool_new_2']], $sent['workflow']['nodes']['lookup']['tools']);
    // The tool body is the tool's wire config.
    $this->assertSame(
      Wire::encode(AgentTest::showOrder()->toJson()),
      Wire::encode(Wire::canonical($server->calls[0]['body']['tool_config'])),
    );
  }

  public function testWorksFromTheAgentsClientToo(): void
  {
    $server = new FakeServer();
    $result = (new AgentsAsCode($server->client()->agents))->push(new Agent('A', prompt: 'p'));
    $this->assertSame('created', $result->action);
  }

  public function testUpdatesOnlyWhatChangedAndLeavesAnotherAgentsSameNamedToolAlone(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(self::supportAgent())->agentId;
    $server->addTool('tool_other', AgentTest::getOrder("Someone else's")->toJson(), ['agent_other']);
    $server->clearCalls();

    $again = $agents->push(self::supportAgent([AgentTest::getOrder('Find an order'), AgentTest::showOrder()]), agentId: $agentId);

    $this->assertSame(['PATCH /v1/convai/tools/tool_new_2', "PATCH /v1/convai/agents/{$agentId}"], $server->writes());
    $this->assertSame(['used_by_agent_id' => $agentId, 'page_size' => '100'], $server->calls[0]['query']);
    $this->assertSame([
      'show_order' => ['id' => 'tool_new_1', 'action' => 'unchanged'],
      'get_order' => ['id' => 'tool_new_2', 'action' => 'updated'],
    ], $again->toArray()['tools']);
    $this->assertSame('updated', $again->action);
    $this->assertSame("Someone else's", $server->tools['tool_other']['config']['description']);
  }

  public function testToolsTheServerAddsFieldsToStillCountAsUnchanged(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(self::supportAgent())->agentId;
    // The API's copy carries fields the builder doesn't model, at the top level and nested, plus nulls.
    $server->tools['tool_new_2']['config']['server_only'] = 'x';
    $server->tools['tool_new_2']['config']['assignments'] = null;
    $server->tools['tool_new_2']['config']['api_schema']['server_nested'] = ['a' => 1];
    $server->clearCalls();

    $again = $agents->push(self::supportAgent(), agentId: $agentId);

    $this->assertSame(["PATCH /v1/convai/agents/{$agentId}"], $server->writes());
    $this->assertSame('unchanged', $again->tools['get_order']->action);
    $this->assertSame('x', $server->tools['tool_new_2']['config']['server_only']);
  }

  public function testReportsToolsTheAgentStoppedUsingAsDetachedWithoutDeletingThem(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(self::supportAgent())->agentId;
    $agent = self::supportAgent();
    $agent->update(tools: []);
    $result = $agents->push($agent, agentId: $agentId);
    $this->assertSame(['id' => 'tool_new_1', 'action' => 'detached'], $result->toArray()['tools']['show_order']);
    $this->assertArrayHasKey('tool_new_1', $server->tools);
    $this->assertNotContains('DELETE', array_column($server->calls, 'method'));
  }

  /** @return array<string, mixed> */
  private static function mcpConfig(): array
  {
    return [
      'type' => 'mcp',
      'name' => 'docs_search',
      'description' => 'Searches the docs',
      'mcp_server_id' => 'mcp_1',
    ];
  }

  public function testLeavesAnMcpToolAttachedByItsIdWithoutCreatingOrUpdatingIt(): void
  {
    $server = new FakeServer();
    $server->addTool('tool_mcp', self::mcpConfig(), ['agent_1']);
    $server->addAgent('agent_1', [
      'name' => 'Docs',
      'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_mcp']]]],
    ]);
    $server->clearCalls();
    $mcp = Tool::fromJson(self::mcpConfig());
    $agent = Agent::fromJson(
      ['name' => 'Docs', 'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_mcp']]]]],
      ['tool_mcp' => $mcp],
    );
    $this->assertSame([], $agent->tools());
    $agent->update(firstMessage: 'Hello');

    $result = self::agents($server)->push($agent, agentId: 'agent_1');

    $this->assertSame(['PATCH /v1/convai/agents/agent_1'], $server->writes());
    $this->assertSame([], $result->toArray()['tools']);
    $this->assertSame(['tool_mcp'], $server->agents['agent_1']['conversation_config']['agent']['prompt']['tool_ids']);
  }

  public function testALoadedMcpToolStaysInToolIdsWhenTheToolsAreReplaced(): void
  {
    $ping = Tool::client('ping', 'Ping the client');
    $agent = Agent::fromJson(
      [
        'name' => 'Docs',
        'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_mcp', 'tool_ping']]]],
      ],
      ['tool_mcp' => Tool::fromJson(self::mcpConfig()), 'tool_ping' => $ping],
    );
    $this->assertSame(['tool_mcp'], $agent->toolIds());
    $this->assertSame([$ping], $agent->tools());

    $agent->update(tools: [AgentTest::getOrder()]);
    $this->assertSame(['tool_mcp'], $agent->toolIds());
    $ids = $agent->toJson(['get_order' => 'tool_get'])['conversation_config']['agent']['prompt']['tool_ids'];
    $this->assertSame(['tool_mcp', 'tool_get'], $ids);
  }

  public function testAddingBackALoadedMcpToolDoesNotAttachItsIdTwice(): void
  {
    $mcp = Tool::fromJson(self::mcpConfig());
    $agent = Agent::fromJson(
      [
        'name' => 'Docs',
        'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_mcp', 'tool_ping']]]],
      ],
      ['tool_mcp' => $mcp, 'tool_ping' => Tool::client('ping', 'Ping the client')],
    );
    $agent->update(tools: [AgentTest::getOrder()]);
    $agent->addTool($mcp);
    $ids = $agent->toJson(['get_order' => 'tool_get'])['conversation_config']['agent']['prompt']['tool_ids'];
    $this->assertSame(['tool_mcp', 'tool_get'], $ids);
  }

  public function testRejectsAnMcpToolWithoutAnIdBeforeAnyRequest(): void
  {
    $wf = new Workflow();
    $wf->converse('triage', 'Find out what the caller needs')
      ->when('Caller asked about the docs')
      ->tool('search', [Tool::fromJson(self::mcpConfig())])
      ->onSuccess()
      ->converse('resolve', 'Answer');
    foreach ([
      new Agent('Docs', prompt: 'p', tools: [Tool::fromJson(self::mcpConfig())]),
      (new Agent('Docs', prompt: 'p'))->addTool(Tool::fromJson(self::mcpConfig())),
      new Agent('Docs', prompt: 'p', workflow: $wf),
    ] as $agent) {
      try {
        $agent->validate();
        $this->fail('expected an AgentValidationError');
      } catch (AgentValidationError $e) {
        $issues = array_values(array_filter($e->issues, static fn($i): bool => $i->code === 'invalid_tool'));
        $this->assertCount(1, $issues);
        $this->assertSame('tools.docs_search', $issues[0]->path);
        $this->assertSame(
          'Tool "docs_search" has type "mcp", which push doesn\'t create or update: load it with its id or attach it with toolIds',
          $issues[0]->message,
        );
      }
      $server = new FakeServer();
      try {
        self::agents($server)->push($agent);
        $this->fail('expected an AgentValidationError');
      } catch (AgentValidationError) {
      }
      $this->assertSame([], $server->calls);
    }
  }

  public function testAWorkflowNodeKeepsAnMcpToolsLoadedId(): void
  {
    $mcp = Tool::fromJson(self::mcpConfig());
    $agent = Agent::fromJson(
      ['name' => 'Docs', 'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p']]]],
      ['tool_mcp' => $mcp],
    );
    $wf = new Workflow();
    $wf->converse('triage', 'Find out what the caller needs')
      ->when('Caller asked about the docs')
      ->tool('search', [$mcp])
      ->onSuccess()
      ->converse('resolve', 'Answer');
    $agent->update(workflow: $wf);
    $this->assertSame([], $agent->tools());
    $this->assertSame([['tool_id' => 'tool_mcp']], $agent->toJson()['workflow']['nodes']['search']['tools']);
  }

  public function testMatchesABranchPushAgainstTheBranchsToolsNotTheMainBranchs(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(self::supportAgent())->agentId;
    // The branch uses its own copy of get_order, and no show_order.
    $server->addTool('tool_branch_order', AgentTest::getOrder('Branch lookup')->toJson());
    /** @var array<string, mixed> $branch */
    $branch = Wire::decodeJson((string) json_encode($server->agents[$agentId]));
    $branch['workflow']['nodes']['lookup']['tools'] = [['tool_id' => 'tool_branch_order']];
    $branch['conversation_config']['agent']['prompt']['tool_ids'] = [];
    $server->branches["{$agentId}/agtbrch_1"] = $branch;
    $server->clearCalls();

    $result = $agents->push(self::supportAgent([AgentTest::getOrder('Changed lookup')]), agentId: $agentId, branchId: 'agtbrch_1');
    $tools = $result->toArray()['tools'];
    $this->assertSame(['id' => 'tool_branch_order', 'action' => 'updated'], $tools['get_order']);
    $this->assertArrayNotHasKey('show_order', $tools); // a main-branch tool the branch never used isn't "detached"
    $this->assertSame(['PATCH /v1/convai/tools/tool_branch_order', "PATCH /v1/convai/agents/{$agentId}"], $server->writes());
    foreach ($server->calls as $call) {
      $this->assertArrayNotHasKey('used_by_agent_id', $call['query']);
    }
    $this->assertSame('agtbrch_1', end($server->calls)['query']['branch_id'] ?? null);
  }

  public function testSendsTheVersionDescription(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(new Agent('A', prompt: 'p'))->agentId;
    $agents->push(new Agent('A', prompt: 'p2'), agentId: $agentId, versionDescription: 'Second');
    $this->assertSame('Second', end($server->calls)['body']['version_description']);
  }

  public function testValidatesBeforeAnyApiCall(): void
  {
    $server = new FakeServer();
    $agent = new Agent('A', prompt: 'p', tools: [Tool::webhook('broken', 'No URL')]);
    try {
      self::agents($server)->push($agent);
      $this->fail('expected an AgentValidationError');
    } catch (AgentValidationError) {
      $this->assertSame([], $server->calls);
    }
  }

  public function testReportsWhatItWroteBeforeAFailure(): void
  {
    $server = new FakeServer();
    $server->failOn = '#^POST /v1/convai/agents/create$#';
    try {
      self::agents($server)->push(self::supportAgent());
      $this->fail('expected an AgentPushError');
    } catch (AgentPushError $e) {
      $this->assertStringStartsWith("Couldn't create agent \"Support line\"", $e->getMessage());
      $this->assertInstanceOf(ElevenlabsApiException::class, $e->getPrevious());
      $this->assertSame([
        'tools' => [
          'show_order' => ['id' => 'tool_new_1', 'action' => 'created'],
          'get_order' => ['id' => 'tool_new_2', 'action' => 'created'],
        ],
      ], $e->result->toArray());
    }
  }

  public function testNamesTheToolInAToolFailure(): void
  {
    $server = new FakeServer();
    $server->failOn = '#^POST /v1/convai/tools$#';
    try {
      self::agents($server)->push(self::supportAgent());
      $this->fail('expected an AgentPushError');
    } catch (AgentPushError $e) {
      $this->assertStringStartsWith("Couldn't create tool \"show_order\"", $e->getMessage());
      $this->assertSame(['tools' => []], $e->result->toArray());
    }
  }

  public function testRefusesAgentIdTogetherWithAProject(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessageMatches('/not both/');
    self::agents(new FakeServer())->push(self::supportAgent(), agentId: 'agent_1', project: AgentProject::fromFiles([]));
  }

  public function testRecordsIdsAndWritesTheCliLayoutThenUpdatesByRecordedId(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $project = AgentProject::fromFiles([]);

    $agents->push(self::supportAgent(), project: $project);
    $files = $project->toFiles();
    $paths = array_keys($files);
    sort($paths);
    $this->assertSame([
      'agent_configs/Support-line.json',
      'agents.json',
      'tool_configs/get_order.json',
      'tool_configs/show_order.json',
      'tools.json',
    ], $paths);
    $this->assertSame(
      "{\n    \"agents\": [\n        {\n            \"config\": \"agent_configs/Support-line.json\",\n            \"id\": \"agent_new_3\"\n        }\n    ]\n}",
      $files['agents.json'],
    );
    $this->assertSame(['tools' => [
      ['type' => 'client', 'config' => 'tool_configs/show_order.json', 'id' => 'tool_new_1'],
      ['type' => 'webhook', 'config' => 'tool_configs/get_order.json', 'id' => 'tool_new_2'],
    ]], self::json($files['tools.json']));
    $this->assertSame(['tool_new_1'], self::json($files['agent_configs/Support-line.json'])['conversation_config']['agent']['prompt']['tool_ids']);

    // A fresh script run: new objects, matched to the project's entries by name.
    $server->clearCalls();
    $reloaded = AgentProject::fromFiles($files);
    $result = $agents->push(self::supportAgent(), project: $reloaded);
    $this->assertSame(['PATCH /v1/convai/agents/agent_new_3'], $server->writes());
    $this->assertSame('unchanged', $result->tools['get_order']->action);
    // Only the version the update reported is new, recorded like the CLI does.
    $this->assertSame(['agents.json'], $reloaded->changedFiles());
    $this->assertSame('ver_1', self::json($reloaded->toFiles()['agents.json'])['agents'][0]['version_id']);
  }

  public function testPushesALoadedAgentsSettingsTheSdkDoesNotModel(): void
  {
    $server = new FakeServer();
    $server->addTool('tool_lookup', ['type' => 'client', 'name' => 'lookup', 'description' => 'old']);
    $project = AgentProject::fromFiles([
      'agents.json' => (string) json_encode(['agents' => [['config' => 'agent_configs/a.json', 'id' => 'agent_1']]]),
      'tools.json' => (string) json_encode(['tools' => [['type' => 'client', 'config' => 'tool_configs/t.json', 'id' => 'tool_lookup']]]),
      'agent_configs/a.json' => (string) json_encode([
        'name' => 'A',
        'conversation_config' => [
          'agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_lookup']]],
          'future_setting' => ['on' => true],
        ],
        'platform_settings' => new \stdClass(),
        'tags' => [],
      ]),
      'tool_configs/t.json' => (string) json_encode(['type' => 'client', 'name' => 'lookup', 'description' => 'd', 'future_field' => 1]),
    ]);
    $server->addAgent('agent_1', []);

    $agent = $project->agent('A');
    $agent->update(firstMessage: 'Hello');
    self::agents($server)->push($agent, project: $project);

    $toolPatch = null;
    $agentPatch = null;
    foreach ($server->calls as $call) {
      if ($call['method'] === 'PATCH') {
        if (str_contains($call['path'], '/tools/')) {
          $toolPatch = $call;
        } else {
          $agentPatch = $call;
        }
      }
    }
    $this->assertSame(1, $toolPatch['body']['tool_config']['future_field'] ?? null);
    $this->assertSame(['on' => true], $agentPatch['body']['conversation_config']['future_setting'] ?? null);
    $this->assertSame('Hello', $agentPatch['body']['conversation_config']['agent']['first_message'] ?? null);
    $changed = $project->changedFiles();
    sort($changed);
    $this->assertSame(['agent_configs/a.json', 'agents.json', 'tool_configs/t.json', 'tools.json'], $changed);
  }

  public function testLoadsAnAgentWithItsToolsAsToolObjectsAndWritesThemIntoAProject(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(self::supportAgent())->agentId;

    $project = AgentProject::fromFiles([]);
    $agent = $agents->pull($agentId, project: $project);
    $this->assertSame('Support line', $agent->name());
    $this->assertSame(['show_order', 'get_order'], array_map(static fn(Tool $t): string => $t->name(), $agent->tools()));
    $this->assertSame($agentId, $project->agentId($agent));

    $files = $project->toFiles();
    $paths = array_keys($files);
    sort($paths);
    $this->assertSame([
      'agent_configs/Support-line.json',
      'agents.json',
      'tool_configs/get_order.json',
      'tool_configs/show_order.json',
      'tools.json',
    ], $paths);
    $config = self::json($files['agent_configs/Support-line.json']);
    $this->assertSame(['conversation_config', 'name', 'platform_settings', 'tags', 'workflow'], array_keys($config));

    // Pushing the pulled agent back changes no tools.
    $server->clearCalls();
    $result = $agents->push($agent, project: $project);
    $this->assertSame(["PATCH /v1/convai/agents/{$agentId}"], $server->writes());
    $this->assertSame(['unchanged', 'unchanged'], array_values(array_map(static fn($t) => $t->action, $result->tools)));
  }

  public function testPullsABranch(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $agentId = (string) $agents->push(new Agent('A', prompt: 'main'))->agentId;
    $server->branches["{$agentId}/agtbrch_1"] = ['name' => 'A', 'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'branch']]]];
    $agent = $agents->pull($agentId, branchId: 'agtbrch_1');
    $this->assertSame('branch', $agent->toJson()['conversation_config']['agent']['prompt']['prompt']);
    $this->assertSame('agtbrch_1', end($server->calls)['query']['branch_id'] ?? null);
  }

  public function testUpdatesAProjectToolWhoseOnlyChangeIsAFieldTheSdkDoesNotModel(): void
  {
    $server = new FakeServer();
    $server->addTool('tool_1', ['type' => 'client', 'name' => 'ping', 'description' => 'd', 'future_field' => 1], ['agent_1']);
    $server->addAgent('agent_1', []);
    $project = AgentProject::fromFiles([
      'agents.json' => (string) json_encode(['agents' => [['config' => 'agent_configs/a.json', 'id' => 'agent_1']]]),
      'tools.json' => (string) json_encode(['tools' => [['type' => 'client', 'config' => 'tool_configs/t.json', 'id' => 'tool_1']]]),
      'agent_configs/a.json' => (string) json_encode(['name' => 'A', 'conversation_config' => ['agent' => ['prompt' => ['prompt' => 'p', 'tool_ids' => ['tool_1']]]]]),
      'tool_configs/t.json' => (string) json_encode(['type' => 'client', 'name' => 'ping', 'description' => 'd', 'future_field' => 2]),
    ]);
    $result = self::agents($server)->push($project->agent('A'), project: $project);
    $this->assertSame('updated', $result->tools['ping']->action);
    $this->assertSame(2, $server->tools['tool_1']['config']['future_field']);
  }

  public function testBringsTheProjectUpToDateWhenTheServerAlreadyMatchesANewDefinition(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $project = AgentProject::fromFiles([]);
    $agents->push(self::supportAgent([AgentTest::getOrder('v2'), AgentTest::showOrder()]), project: $project);
    $stale = AgentProject::fromFiles(array_merge($project->toFiles(), [
      'tool_configs/get_order.json' => (string) json_encode(AgentTest::getOrder('v1')->toJson(), JSON_PRETTY_PRINT),
    ]));
    $result = $agents->push(self::supportAgent([AgentTest::getOrder('v2'), AgentTest::showOrder()]), project: $stale);
    $this->assertSame('unchanged', $result->tools['get_order']->action);
    $this->assertSame('v2', self::json($stale->toFiles()['tool_configs/get_order.json'])['description']);
  }

  public function testDoesNotReportAToolAsDetachedWhileTheWorkflowStillUsesItsId(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $server->addTool('tool_raw', AgentTest::showOrder()->toJson());
    $wf = new Workflow();
    $wf->tool('run', ['tool_raw']);
    $agent = new Agent('A', prompt: 'p', workflow: $wf);
    $agentId = (string) $agents->push($agent)->agentId;
    $again = $agents->push($agent, agentId: $agentId);
    $this->assertSame([], $again->tools);
  }

  public function testKeepsAProjectToolsUnmodeledFieldsWhenTheSameToolIsRebuiltInCode(): void
  {
    $server = new FakeServer();
    $agents = self::agents($server);
    $project = AgentProject::fromFiles([]);
    $agents->push(self::supportAgent(), project: $project);
    $files = $project->toFiles();
    $withExtra = self::json($files['tool_configs/get_order.json']);
    $withExtra['future_field'] = 1;
    $files['tool_configs/get_order.json'] = (string) json_encode($withExtra, JSON_PRETTY_PRINT);
    $server->tools['tool_new_2']['config'] = $withExtra;

    $reloaded = AgentProject::fromFiles($files);
    $result = $agents->push(self::supportAgent(), project: $reloaded);
    $this->assertSame('unchanged', $result->tools['get_order']->action);
    $this->assertSame(1, self::json($reloaded->toFiles()['tool_configs/get_order.json'])['future_field']);
  }

  public function testFollowsTheToolListCursor(): void
  {
    $server = new FakeServerPaged();
    $agents = self::agents($server);
    $server->addTool('tool_a', ['type' => 'client', 'name' => 'a', 'description' => 'A'], ['agent_1']);
    $server->addTool('tool_b', ['type' => 'client', 'name' => 'b', 'description' => 'B'], ['agent_1']);
    $server->addAgent('agent_1', ['name' => 'X']);
    $result = $agents->push(new Agent('X', prompt: 'p', tools: []), agentId: 'agent_1');
    $this->assertSame(['a', 'b'], array_keys($result->tools));
    $this->assertSame('page_2', $server->calls[1]['query']['cursor'] ?? null);
  }
}
