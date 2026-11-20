<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentTools;

use ElevenLabs\AgentTools\AuthConnection;
use ElevenLabs\AgentTools\Header;
use ElevenLabs\AgentTools\Schema;
use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentTools\ToolValidationError;
use ElevenLabs\AgentWorkflows\Destination;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Types\ToolRequestModel;
use PHPUnit\Framework\TestCase;

/**
 * Runs the shared cross-SDK conformance fixtures (docs/agents-as-code/fixtures/tools in the JS
 * SDK, copied verbatim into tests/fixtures/agent_tools) through the PHP builder. See
 * tool-spec.md, "Fixtures".
 */
class ToolFixtureTest extends TestCase
{
  /** Which argument of an op is a schema, given in wire format or as `{"build": [ops]}`. */
  private const SCHEMA_ARG = ['pathParam' => 1, 'queryParam' => 1, 'body' => 0, 'response' => 0, 'param' => 1, 'property' => 1];

  /** Ops whose last argument is an options object, passed as named arguments. */
  private const OPTIONS_ARG = ['options' => 0, 'assign' => 2, 'transfer' => 2];

  /**
   * @return iterable<string, array{string}>
   */
  public static function fixtures(): iterable
  {
    $dir = __DIR__ . '/../fixtures/agent_tools';
    foreach (glob("{$dir}/*.json") ?: [] as $path) {
      yield basename($path) => [$path];
    }
  }

  public function testAllSharedFixturesArePresent(): void
  {
    $this->assertCount(23, iterator_to_array(self::fixtures()));
  }

  /**
   * @dataProvider fixtures
   */
  public function testFixture(string $path): void
  {
    // Decoded keeping `{}` distinct from `[]`, as the builder's own loader does.
    /** @var array<string, mixed> $fixture */
    $fixture = Wire::decodeJson((string) file_get_contents($path));

    if (isset($fixture['schema'])) {
      $json = Wire::encode($this->buildSchema($fixture['schema'])->toJson());
      $this->assertSame(Wire::encode(Wire::canonical($fixture['expected'])), $json, $fixture['name']);
      return;
    }

    $tool = $this->tool($fixture);
    foreach ($fixture['ops'] ?? [] as $op) {
      $this->call($tool, $op);
    }

    if (isset($fixture['errors'])) {
      try {
        $tool->toJsonString();
        $this->fail("Expected build to fail with errors for {$fixture['name']}");
      } catch (ToolValidationError $e) {
        $codes = array_map(static fn($issue) => $issue->code, $e->issues);
        sort($codes);
        $expected = $fixture['errors'];
        sort($expected);
        $this->assertSame($expected, $codes, $fixture['name']);
      }
      return;
    }

    $expected = Wire::encode(Wire::canonical($fixture['expected']));
    $this->assertSame($expected, $tool->toJsonString(), $fixture['name']);

    // The same tool also builds the generated request model, which the client accepts.
    try {
      $model = $tool->build();
    } catch (ToolValidationError $e) {
      // The generated TransferToNumberToolConfigInput predates transfer_rules, so build() refuses to
      // drop them. Only that fixture may fail here, and only for that field; the checks below run for
      // it too once the SDK is regenerated with the field.
      if (basename($path) !== '22-transfer-rules.json') {
        throw $e;
      }
      $this->assertSame(
        ['invalid_model@params.transfer_rules'],
        array_map(static fn($issue) => "{$issue->code}@{$issue->path}", $e->issues),
        $fixture['name']
      );
      return;
    }
    $this->assertInstanceOf(ToolRequestModel::class, $model);
    $model->validate();
    $this->assertSame($fixture['expected']['type'], $model->toolConfig->type, $fixture['name']);
    // The model sends everything the wire format has. (It may add a generated default, such as a
    // response filter's `content_type`.)
    $sent = Wire::toWire($model);
    $this->assertIsArray($sent);
    $this->assertWireSubset($fixture['expected'], $sent['tool_config'], $fixture['name']);

    // And its canonical output loads back and writes the same bytes.
    $this->assertSame($expected, Tool::fromJson($expected)->toJsonString(), $fixture['name']);
  }

  /**
   * Every field of `$expected` is in `$actual` with the same value; maps may have extra keys.
   */
  private function assertWireSubset(mixed $expected, mixed $actual, string $where): void
  {
    if ($expected instanceof \stdClass) {
      $expected = (array) $expected;
    }
    if ($actual instanceof \stdClass) {
      $actual = (array) $actual;
    }
    if (is_array($expected) && !array_is_list($expected)) {
      $this->assertIsArray($actual, $where);
      foreach ($expected as $key => $value) {
        $this->assertArrayHasKey($key, $actual, "{$where}: {$key}");
        $this->assertWireSubset($value, $actual[$key], "{$where}.{$key}");
      }
      return;
    }
    if (is_array($expected)) {
      $this->assertIsArray($actual, $where);
      $this->assertCount(count($expected), $actual, $where);
      foreach ($expected as $i => $value) {
        $this->assertWireSubset($value, $actual[$i], "{$where}[{$i}]");
      }
      return;
    }
    $this->assertSame(Wire::canonical($expected), Wire::canonical($actual), $where);
  }

  /**
   * @param array<string, mixed> $fixture
   */
  private function tool(array $fixture): Tool
  {
    if (isset($fixture['from'])) {
      return Tool::fromJson($fixture['from']);
    }
    $spec = $fixture['tool'];
    if (isset($spec['webhook'])) {
      return Tool::webhook(...$spec['webhook']);
    }
    if (isset($spec['client'])) {
      return Tool::client(...$spec['client']);
    }
    $options = $spec['systemOptions'] ?? [];
    return match ($spec['system']) {
      'end_call' => SystemTool::endCall(),
      'skip_turn' => SystemTool::skipTurn(...$options),
      'language_detection' => SystemTool::languageDetection(...$options),
      'play_keypad_touch_tone' => SystemTool::playKeypadTouchTone(...$options),
      'voicemail_detection' => SystemTool::voicemailDetection(...$options),
      'knowledge_base' => SystemTool::knowledgeBase(...$options),
      'transfer_to_number' => SystemTool::transferToNumber(...$options),
      'transfer_to_agent' => SystemTool::transferToAgent(),
      default => throw new \RuntimeException("Unknown system tool \"{$spec['system']}\""),
    };
  }

  /**
   * Calls one fixture op on `$target`, with builder values converted from their fixture form.
   *
   * @param array<string, mixed> $op
   */
  private function call(object $target, array $op): mixed
  {
    $name = $op['op'];
    if (!method_exists($target, $name)) {
      throw new \RuntimeException("Unknown fixture op \"{$name}\"");
    }
    $args = $op['args'] ?? [];
    if (isset(self::SCHEMA_ARG[$name])) {
      $args[self::SCHEMA_ARG[$name]] = $this->schemaArg($args[self::SCHEMA_ARG[$name]]);
    }
    if ($name === 'header') {
      $args[1] = $this->header($args[1]);
    }
    if ($name === 'auth') {
      $args[0] = isset($args[0]['id']) ? AuthConnection::id($args[0]['id']) : AuthConnection::envVar($args[0]['envVar']);
    }
    if ($name === 'transfer') {
      $args[1] = $this->destination($args[1]);
    }
    // An options object is spread as named arguments, which is how PHP callers pass them.
    $named = [];
    $index = self::OPTIONS_ARG[$name] ?? null;
    if ($index !== null && array_key_exists($index, $args)) {
      $named = $args[$index] instanceof \stdClass ? [] : $args[$index];
      unset($args[$index]);
    }
    return $target->{$name}(...array_values($args), ...$named);
  }

  /**
   * A schema argument is wire-format JSON, or `{"build": [ops]}` for one built with Schema
   * methods (needed for `optional()`, which has no wire form of its own).
   */
  private function schemaArg(mixed $raw): Schema
  {
    if (is_array($raw) && isset($raw['build'])) {
      return $this->buildSchema($raw['build']);
    }
    return Schema::fromJson($raw instanceof \stdClass ? [] : $raw);
  }

  /**
   * @param list<array<string, mixed>> $ops The first op is a constructor; each later op is a
   *   method called on the previous result.
   */
  private function buildSchema(array $ops): Schema
  {
    $first = array_shift($ops);
    $schema = match ($first['op']) {
      'array' => Schema::array($this->schemaArg($first['args'][0])),
      'fromJSON' => Schema::fromJson($first['args'][0]),
      'string' => Schema::string(),
      'integer' => Schema::integer(),
      'number' => Schema::number(),
      'bool' => Schema::bool(),
      'object' => Schema::object(),
      default => throw new \RuntimeException("Unknown schema constructor \"{$first['op']}\""),
    };
    foreach ($ops as $op) {
      $schema = $this->call($schema, $op);
    }
    /** @var Schema $schema */
    return $schema;
  }

  /**
   * @param array<string, string> $raw
   */
  private function header(array $raw): Header
  {
    return match (true) {
      isset($raw['value']) => Header::value($raw['value']),
      isset($raw['secret']) => Header::secret($raw['secret']),
      isset($raw['variable']) => Header::variable($raw['variable']),
      default => Header::envVar($raw['envVar']),
    };
  }

  /**
   * @param array<string, mixed> $raw
   */
  private function destination(array $raw): Destination
  {
    if (isset($raw['phone'])) {
      return Destination::phone($raw['phone']);
    }
    if (isset($raw['phoneVariable'])) {
      return Destination::phoneVariable($raw['phoneVariable']);
    }
    if (isset($raw['sip'])) {
      return Destination::sip($raw['sip']);
    }
    if (isset($raw['sipVariable'])) {
      return Destination::sipVariable($raw['sipVariable']);
    }
    return Destination::agent($raw['agent'], $raw['nodeId'] ?? null);
  }
}
