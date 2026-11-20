<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentsAsCode;

use ElevenLabs\AgentsAsCode\Agent;
use ElevenLabs\AgentsAsCode\AgentProject;
use ElevenLabs\AgentsAsCode\AgentProjectError;
use ElevenLabs\AgentsAsCode\AgentsAsCode;
use ElevenLabs\AgentsAsCode\ProjectFormat;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
  /** @var list<string> */
  private array $tempDirs = [];

  protected function tearDown(): void
  {
    foreach ($this->tempDirs as $dir) {
      self::removeTree($dir);
    }
    $this->tempDirs = [];
  }

  /**
   * Every file under `$dir`, keyed by relative path.
   *
   * @return array<string, string>
   */
  private static function readTree(string $dir): array
  {
    $files = [];
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
    foreach ($iterator as $file) {
      /** @var \SplFileInfo $file */
      if ($file->isFile()) {
        $files[substr($file->getPathname(), strlen($dir) + 1)] = (string) file_get_contents($file->getPathname());
      }
    }
    ksort($files);
    return $files;
  }

  private static function removeTree(string $dir): void
  {
    if (is_link($dir) || is_file($dir)) {
      unlink($dir);
      return;
    }
    if (!is_dir($dir)) {
      return;
    }
    foreach (scandir($dir) ?: [] as $name) {
      if ($name !== '.' && $name !== '..') {
        self::removeTree("{$dir}/{$name}");
      }
    }
    rmdir($dir);
  }

  private function tempDir(string $prefix): string
  {
    $dir = sys_get_temp_dir() . "/{$prefix}" . bin2hex(random_bytes(6));
    mkdir($dir);
    $this->tempDirs[] = $dir;
    return (string) realpath($dir);
  }

  public function testLoadsACliProjectWithToolsByIdAgentsWithToolObjectsAndUnknownIdsKept(): void
  {
    $project = AgentProject::fromFiles(self::readTree(AgentTest::CLI_PROJECT));
    $this->assertSame(['Support', 'Billing'], array_map(static fn(Agent $a): string => $a->name(), $project->agents()));
    $this->assertSame(['lookup_order', 'issue_refund'], array_map(static fn(Tool $t): string => $t->name(), $project->tools()));

    $support = $project->agent('Support');
    $this->assertSame($support, $project->agent('Support'));
    $this->assertSame(['lookup_order'], array_map(static fn(Tool $t): string => $t->name(), $support->tools()));
    $this->assertSame(['tool_from_dashboard'], $support->toolIds());
    $this->assertSame('agent_support', $project->agentId($support));
    $this->assertSame('tool_lookup', $project->toolId($support->tools()[0]));
    $this->assertSame($project->tools()[0], $support->tools()[0]);

    $billing = $project->agent('Billing');
    $this->assertSame('agent_billing', $project->agentId($billing));
    $this->assertSame(['issue_refund'], array_map(static fn(Tool $t): string => $t->name(), $billing->tools()));
    $this->assertSame([], $billing->toolIds());
  }

  public function testGivesBackEveryFileUnchangedWhenNothingWasPushedOrPulled(): void
  {
    $files = self::readTree(AgentTest::CLI_PROJECT);
    $out = AgentProject::fromFiles($files)->toFiles();
    ksort($out);
    $this->assertSame($files, $out);
  }

  public function testRoundTripsTheSupportConfigToItsSortedForm(): void
  {
    $project = AgentProject::fromFiles(self::readTree(AgentTest::CLI_PROJECT));
    $support = $project->agent('Support');
    $expected = ProjectFormat::formatConfig(AgentTest::readJson('agent_configs/support.json'));
    $this->assertSame($expected, ProjectFormat::formatConfig($support->toJson(['lookup_order' => 'tool_lookup'])));
  }

  public function testReportsMissingMalformedAndNotYetSupportedFilesClearly(): void
  {
    $index = static fn(string $config): string => (string) json_encode(['agents' => [['config' => $config]]]);
    $cases = [
      [['agents.json' => $index('agent_configs/a.yaml')], '/only JSON config files are supported yet/'],
      [['agents.json' => $index('agent_configs/a.toml')], '/YAML and TOML/'],
      [['agents.json' => $index('agent_configs/a.json')], '#points at agent_configs/a.json, which doesn\'t exist#'],
      [['agents.json' => '{'], '/isn\'t valid JSON/'],
    ];
    foreach ($cases as [$files, $pattern]) {
      try {
        AgentProject::fromFiles($files);
        $this->fail("expected an AgentProjectError for {$pattern}");
      } catch (AgentProjectError $e) {
        $this->assertMatchesRegularExpression($pattern, $e->getMessage());
      }
    }
    $this->expectException(AgentProjectError::class);
    $this->expectExceptionMessage('No agent named "Nope"');
    AgentProject::fromFiles([])->agent('Nope');
  }

  public function testNamesNewFilesLikeTheCli(): void
  {
    $this->assertSame('Support-line-EU', ProjectFormat::sanitizeFilename('  Support line / EU '));
    $this->assertSame('_hidden', ProjectFormat::sanitizeFilename('.hidden'));
    $this->assertSame('unnamed', ProjectFormat::sanitizeFilename('...'));
    $this->assertSame('unnamed', ProjectFormat::sanitizeFilename('   '));
    $this->assertSame('a-b-c', ProjectFormat::sanitizeFilename('a:*b??"c'));
    $this->assertSame(str_repeat('é', 100), ProjectFormat::sanitizeFilename(str_repeat('é', 120)));
    $this->assertSame(
      'agent_configs/A-2.json',
      ProjectFormat::uniquePath('agent_configs', 'A', ['agent_configs/A.json' => true, 'agent_configs/A-1.json' => true]),
    );
  }

  public function testWritesTheCliFormat(): void
  {
    $this->assertSame("{\n    \"a\": [],\n    \"b\": {}\n}", ProjectFormat::formatIndex(['a' => [], 'b' => new \stdClass()]));
    $this->assertSame("{\n    \"a\": 1,\n    \"b\": \"x/y\"\n}", ProjectFormat::formatConfig(['b' => 'x/y', 'a' => 1.0]));
  }

  public function testOpensAnEmptyDirectoryAndPushWritesTheCliLayoutOwnerOnly(): void
  {
    $dir = $this->tempDir('agents-');
    mkdir("{$dir}/agent_configs");
    file_put_contents("{$dir}/agent_configs/A.json", 'not ours'); // a file the project doesn't list
    $project = AgentProject::open($dir);
    $server = new FakeServer();
    $agent = new Agent('A', prompt: 'p', tools: [Tool::client('ping', 'Ping the app')]);

    (new AgentsAsCode($server->client()))->push($agent, project: $project);

    $files = self::readTree($dir);
    $this->assertSame(
      ['agent_configs/A-1.json', 'agent_configs/A.json', 'agents.json', 'tool_configs/ping.json', 'tools.json'],
      array_keys($files),
    );
    $this->assertSame('not ours', $files['agent_configs/A.json']);
    $this->assertSame(
      "{\n    \"description\": \"Ping the app\",\n    \"name\": \"ping\",\n    \"type\": \"client\"\n}",
      $files['tool_configs/ping.json'],
    );
    clearstatcache();
    $this->assertSame(0600, fileperms("{$dir}/agents.json") & 0777);
    $this->assertSame(0600, fileperms("{$dir}/tool_configs/ping.json") & 0777);
    $this->assertSame([], $project->changedFiles());

    $reopened = AgentProject::open($dir);
    $this->assertSame($project->agentId($agent), $reopened->agentId($reopened->agent('A')));
  }

  public function testSavesWhatWasWrittenBeforeAFailedPush(): void
  {
    $dir = $this->tempDir('agents-');
    $project = AgentProject::open($dir);
    $server = new FakeServer();
    $server->failOn = '#^POST /v1/convai/agents/create$#';
    $agent = new Agent('A', prompt: 'p', tools: [Tool::client('ping', 'Ping the app')]);
    try {
      (new AgentsAsCode($server->client()))->push($agent, project: $project);
      $this->fail('expected an AgentPushError');
    } catch (\ElevenLabs\AgentsAsCode\AgentPushError) {
    }
    $reopened = AgentProject::open($dir);
    $this->assertSame('tool_new_1', $reopened->toolId($reopened->tools()[0]));
    $this->assertSame([], $reopened->agents());
  }

  public function testRefusesConfigPathsOutsideTheProjectDirectlyOrThroughASymlink(): void
  {
    $outside = $this->tempDir('outside-');
    file_put_contents("{$outside}/a.json", '{}');

    $escaping = $this->tempDir('agents-');
    file_put_contents("{$escaping}/agents.json", (string) json_encode(['agents' => [['config' => '../a.json']]]));
    try {
      AgentProject::open($escaping);
      $this->fail('expected an AgentProjectError');
    } catch (AgentProjectError $e) {
      $this->assertStringContainsString('outside the project', $e->getMessage());
    }

    $linked = $this->tempDir('agents-');
    symlink($outside, "{$linked}/agent_configs");
    file_put_contents("{$linked}/agents.json", (string) json_encode(['agents' => [['config' => 'agent_configs/a.json']]]));
    try {
      AgentProject::open($linked);
      $this->fail('expected an AgentProjectError');
    } catch (AgentProjectError $e) {
      $this->assertStringContainsString('through a symlink', $e->getMessage());
    }
  }

  public function testNeverWritesThroughASymlink(): void
  {
    $outside = $this->tempDir('outside-');
    file_put_contents("{$outside}/victim.json", 'keep');
    $dir = $this->tempDir('agents-');
    file_put_contents("{$dir}/victim.json", 'keep');
    $agent = new Agent('A', prompt: 'p');

    foreach (["{$dir}/victim.json" => '/it\'s a symlink/', "{$outside}/victim.json" => '/through a symlink/'] as $target => $pattern) {
      @mkdir("{$dir}/agent_configs");
      @unlink("{$dir}/agent_configs/A.json");
      $project = AgentProject::open($dir);
      // Planted after the project was opened, where push will write the new agent's config.
      symlink($target, "{$dir}/agent_configs/A.json");
      $project->recordAgent($agent, 'agent_1', $agent->toJson());
      $this->assertContains('agent_configs/A.json', $project->changedFiles());
      try {
        $project->save();
        $this->fail('expected an AgentProjectError');
      } catch (AgentProjectError $e) {
        $this->assertMatchesRegularExpression($pattern, $e->getMessage());
      }
      $this->assertSame('keep', file_get_contents($target));
    }
  }

  public function testSaveNeedsADirectory(): void
  {
    $this->expectException(AgentProjectError::class);
    AgentProject::fromFiles([])->save();
  }

  public function testRejectsABranchTheProjectHasNoFileForBeforeAnyRequest(): void
  {
    $project = AgentProject::fromFiles(self::readTree(AgentTest::CLI_PROJECT));
    $server = new FakeServer();
    $agents = new AgentsAsCode($server->client());
    foreach ([
      fn() => $agents->push($project->agent('Billing'), project: $project, branchId: 'agtbrch_x'),
      fn() => $agents->pull('agent_support', project: $project, branchId: 'agtbrch_x'),
    ] as $call) {
      try {
        $call();
        $this->fail('expected an AgentProjectError');
      } catch (AgentProjectError $e) {
        $this->assertStringContainsString('has no config file', $e->getMessage());
      }
    }
    $this->assertSame([], $server->calls);
  }

  public function testPushesARecordedBranchIntoItsOwnFile(): void
  {
    $project = AgentProject::fromFiles(self::readTree(AgentTest::CLI_PROJECT));
    $server = new FakeServer();
    $server->addTool('tool_lookup', AgentTest::readJson('tool_configs/lookup_order.json'), ['agent_support']);
    $server->addTool('tool_refund', AgentTest::readJson('tool_configs/issue_refund.json'), ['agent_billing']);
    $server->addAgent('agent_support', AgentTest::readJson('agent_configs/support.json'));
    $server->branches['agent_support/agtbrch_beta'] = AgentTest::readJson('agent_configs/support.beta.json');
    $support = $project->agent('Support');
    $support->update(firstMessage: 'Hi from beta');
    $result = (new AgentsAsCode($server->client()))->push($support, project: $project, branchId: 'agtbrch_beta');

    $this->assertSame('updated', $result->action);
    $this->assertSame('agtbrch_beta', end($server->calls)['query']['branch_id'] ?? null);
    $this->assertContains('agent_configs/support.beta.json', $project->changedFiles());
    $this->assertNotContains('agent_configs/support.json', $project->changedFiles());
    $index = json_decode($project->toFiles()['agents.json'], true);
    $this->assertSame('ver_1', $index['agents'][0]['branches']['beta']['version_id']);
    $this->assertArrayNotHasKey('version_id', $index['agents'][0]);
  }

  public function testKeepsTheMainAgentWhenABranchIsRecordedAndTheToolTypeInStep(): void
  {
    $project = AgentProject::fromFiles(self::readTree(AgentTest::CLI_PROJECT));
    $main = $project->agent('Support');
    $beta = Agent::fromJson(AgentTest::readJson('agent_configs/support.beta.json'));
    $project->recordAgent($beta, 'agent_support', $beta->toJson(), branchId: 'agtbrch_beta', matchBy: 'id');
    $this->assertSame($main, $project->agent('Support'));
    $this->assertContains('agent_configs/support.beta.json', $project->changedFiles());
    $this->assertNotContains('agent_configs/support.json', $project->changedFiles());

    $lookup = $project->tools()[0];
    $client = Tool::client('lookup_order', 'Now a client tool');
    $project->recordTool($client, (string) $project->toolId($lookup), $client->toJson(), 'id');
    $this->assertSame('client', json_decode($project->toFiles()['tools.json'], true)['tools'][0]['type']);
  }

  public function testDropsAPendingWriteOnceAFileIsBackToWhatWasLoaded(): void
  {
    $loaded = ['name' => 'A', 'conversation_config' => new \stdClass(), 'platform_settings' => new \stdClass(), 'tags' => []];
    $files = [
      'agents.json' => ProjectFormat::formatIndex(['agents' => [['config' => 'agent_configs/a.json', 'id' => 'agent_1']]]),
      'agent_configs/a.json' => ProjectFormat::formatConfig($loaded),
    ];
    $project = AgentProject::fromFiles($files);
    $agent = $project->agent('A');
    $project->recordAgent($agent, 'agent_1', array_merge($loaded, ['tags' => ['x']]));
    $this->assertSame(['agent_configs/a.json'], $project->changedFiles());
    $project->recordAgent($agent, 'agent_1', $loaded);
    $this->assertSame([], $project->changedFiles());
    $this->assertEquals(array_merge($files, ['tools.json' => "{\n    \"tools\": []\n}"]), $project->toFiles());
  }

  public function testRefusesTwoEntriesWithTheSameName(): void
  {
    $config = ProjectFormat::formatConfig(['type' => 'client', 'name' => 'ping', 'description' => 'd']);
    $project = AgentProject::fromFiles([
      'tools.json' => (string) json_encode(['tools' => [
        ['type' => 'client', 'config' => 'tool_configs/a.json', 'id' => 'tool_a'],
        ['type' => 'client', 'config' => 'tool_configs/b.json', 'id' => 'tool_b'],
      ]]),
      'tool_configs/a.json' => $config,
      'tool_configs/b.json' => $config,
    ]);
    $this->assertSame('tool_a', $project->toolId($project->tools()[0])); // the loaded object matches its own entry
    $this->expectException(AgentProjectError::class);
    $this->expectExceptionMessageMatches('/2 entries in tools.json are named "ping"/');
    $project->toolId(Tool::client('ping', 'd'));
  }

  public function testKeepsTheBytesOfUnchangedFilesEvenWhenTheyAreNotInTheCliFormat(): void
  {
    $files = [
      'agents.json' => '{"agents":[{"config":"agent_configs/a.json"}]}' . "\n",
      'agent_configs/a.json' => '{ "name": "A", "conversation_config": {}, "tags": [] }',
    ];
    $this->assertEquals(
      array_merge($files, ['tools.json' => "{\n    \"tools\": []\n}"]),
      AgentProject::fromFiles($files)->toFiles(),
    );
    $this->assertSame(Wire::encode(Wire::canonical(['conversation_config' => new \stdClass(), 'name' => 'A', 'platform_settings' => new \stdClass(), 'tags' => []])), Wire::encode(AgentProject::fromFiles($files)->agent('A')->toJson()));
  }
}
