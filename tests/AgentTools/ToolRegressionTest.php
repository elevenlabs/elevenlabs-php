<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentTools;

use ElevenLabs\AgentTools\Schema;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentTools\ToolIssue;
use ElevenLabs\AgentTools\ToolValidationError;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Types\ToolResponseModel;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for review findings on the tool builder: emptying fields, empty URLs, loaded
 * schema types, null and `{}` constants, numeric property names, and loading generated models.
 */
class ToolRegressionTest extends TestCase
{
  // Rule 1: removing the last entry leaves the field out.

  public function testRemovingTheLastAssignmentOmitsAssignments(): void
  {
    $json = $this->webhook()->assign('a', 'x.a')->removeAssignment('a')->toJson();
    $this->assertArrayNotHasKey('assignments', $json);

    $json = $this->webhook()->assign('a', 'x.a')->assign('b', 'x.b')->removeAssignment('a')->toJson();
    $this->assertSame(['b'], array_column($json['assignments'], 'dynamic_variable'));
  }

  public function testLoadedEmptyAssignmentsRoundTripAndRemovingAMissingOneChangesNothing(): void
  {
    $loaded = $this->webhookWire(['assignments' => []]);
    $this->assertSame([], Tool::fromJson($loaded)->toJson()['assignments']);
    $this->assertSame([], Tool::fromJson($loaded)->asWebhook()?->removeAssignment('missing')->toJson()['assignments']);
  }

  public function testRemovingTheLastClientParamOmitsParameters(): void
  {
    $tool = Tool::client('show', 'Show')->param('a', Schema::string()->describe('A'))->removeParam('a');
    $this->assertArrayNotHasKey('parameters', $tool->toJson());
    $this->assertNull($tool->parametersSchema());
  }

  public function testLoadedEmptyParametersRoundTripAndRemovingAMissingOneChangesNothing(): void
  {
    foreach ([
      ['type' => 'object'],
      ['type' => 'object', 'properties' => new \stdClass(), 'required' => []],
    ] as $parameters) {
      $wire = ['type' => 'client', 'name' => 'c', 'description' => 'C', 'parameters' => $parameters];
      $expected = Wire::encode(Wire::canonical($wire));
      $this->assertSame($expected, Tool::fromJson($wire)->toJsonString());
      $this->assertSame($expected, Tool::fromJson($wire)->asClient()?->removeParam('missing')->toJsonString());
    }
  }

  public function testRemovingTheLastQueryParamOmitsTheQuerySchema(): void
  {
    $json = $this->webhook()->queryParam('q', Schema::string()->describe('Q'))->removeQueryParam('q')->toJson();
    $this->assertArrayNotHasKey('query_params_schema', $json['api_schema']);
  }

  // Rule 2: an empty URL counts as missing.

  public function testEmptyUrlIsMissing(): void
  {
    $this->assertSame(['missing_url'], $this->errors(Tool::webhook('w', 'W')->get('')));
    $loaded = $this->webhookWire();
    $loaded['api_schema']['url'] = '';
    $this->assertSame(['missing_url'], $this->errors(Tool::fromJson($loaded)));
  }

  // Rule 3: a loaded schema is an object only when it has no type.

  public function testLoadedBodyAndResponseOfAnotherTypeAreReported(): void
  {
    $string = ['type' => 'string', 'description' => 'X'];
    $wire = $this->webhookWire([], ['method' => 'POST', 'request_body_schema' => $string, 'response_body_schema' => $string]);
    $this->assertSame(['body_not_object', 'body_not_object'], $this->errors(Tool::fromJson($wire)));
  }

  public function testLoadedParamsAndQueryOfAnotherTypeAreReported(): void
  {
    $string = ['type' => 'string', 'description' => 'X'];
    $client = Tool::fromJson(['type' => 'client', 'name' => 'c', 'description' => 'C', 'parameters' => $string]);
    $this->assertSame(['body_not_object'], $this->errors($client));
    $this->assertSame('params', $this->issues($client)[0]->path);

    $webhook = Tool::fromJson($this->webhookWire([], ['query_params_schema' => $string]));
    $this->assertSame(['body_not_object'], $this->errors($webhook));
    $this->assertSame('query', $this->issues($webhook)[0]->path);
  }

  public function testLoadedEmptySchemasAreEmptyObjects(): void
  {
    $json = '{"type":"webhook","name":"w","description":"W","api_schema":{"method":"POST",'
      . '"url":"https://api.example.com","request_body_schema":{},"response_body_schema":{},"query_params_schema":{}}}';
    $fromString = Tool::fromJson($json)->toJsonString();
    $api = Wire::decodeJson($fromString)['api_schema'];
    $this->assertSame(['type' => 'object'], $api['request_body_schema']);
    $this->assertSame(['type' => 'object'], $api['response_body_schema']);
    // A query schema's type stays the builder's, so an empty one writes back as `{}`.
    $this->assertEquals(new \stdClass(), $api['query_params_schema']);

    $array = $this->webhookWire([], [
      'method' => 'POST',
      'request_body_schema' => new \stdClass(),
      'response_body_schema' => new \stdClass(),
      'query_params_schema' => new \stdClass(),
    ]);
    $tool = Tool::fromJson($array);
    $this->assertSame($fromString, $tool->toJsonString());
    $tool->build()->validate();

    $client = Tool::fromJson(['type' => 'client', 'name' => 'c', 'description' => 'C', 'parameters' => new \stdClass()]);
    $this->assertSame(['type' => 'object'], $client->toJson()['parameters']);
  }

  public function testLoadedSchemasWithoutATypeWriteObjectButQueryKeepsItsOwn(): void
  {
    $properties = ['a' => ['type' => 'string', 'description' => 'A']];
    $wire = $this->webhookWire([], [
      'method' => 'POST',
      'request_body_schema' => ['properties' => $properties],
      'query_params_schema' => ['properties' => ['q' => ['type' => 'string', 'description' => 'Q']]],
    ]);
    $api = Tool::fromJson($wire)->toJson()['api_schema'];
    $this->assertSame('object', $api['request_body_schema']['type']);
    $this->assertArrayNotHasKey('type', $api['query_params_schema']);

    $wire['api_schema']['query_params_schema']['type'] = 'object';
    $this->assertSame('object', Tool::fromJson($wire)->toJson()['api_schema']['query_params_schema']['type']);
  }

  // Rule 4: a null constant on a nullable literal.

  public function testNullConstantsReachToJsonAndBuild(): void
  {
    $nullable = ['type' => ['integer', 'null'], 'constant_value' => null];
    $wire = $this->webhookWire([], [
      'method' => 'POST',
      'url' => 'https://api.example.com/{n}',
      'path_params_schema' => ['n' => $nullable],
      'query_params_schema' => ['properties' => ['q' => $nullable], 'required' => ['q']],
      'request_body_schema' => ['type' => 'object', 'properties' => ['b' => $nullable], 'required' => ['b']],
    ]);
    $tool = Tool::fromJson($wire);

    $expected = Wire::canonical($nullable);
    foreach ([Wire::canonical($tool->toJson()), Wire::canonical(Wire::toWire($tool->build())['tool_config'])] as $out) {
      $api = $out['api_schema'];
      $this->assertSame($expected, $api['path_params_schema']['n']);
      $this->assertSame($expected, $api['query_params_schema']['properties']['q']);
      $this->assertSame($expected, $api['request_body_schema']['properties']['b']);
    }
  }

  // Rule 5: a loaded query schema keeps every loaded field.

  public function testLoadedQuerySchemaKeepsItsFields(): void
  {
    foreach ([
      ['x_extra' => 1],
      ['description' => 'Filters', 'properties' => ['q' => ['type' => 'string', 'description' => 'Q']], 'required' => ['q']],
    ] as $query) {
      $wire = $this->webhookWire([], ['query_params_schema' => $query]);
      $this->assertSame(Wire::encode(Wire::canonical($wire)), Tool::fromJson($wire)->toJsonString());
    }
  }

  // PHP: numeric property names are map keys, not list indexes.

  public function testNumericPropertyNamesStayAMap(): void
  {
    $literal = ['type' => 'string', 'description' => 'X'];
    $tool = Tool::webhook('w', 'W')
      ->post('https://api.example.com/{0}')
      ->pathParam('0', Schema::fromJson($literal))
      ->queryParam('1', Schema::fromJson($literal))
      ->body(Schema::object()->property('2', Schema::string()->describe('Two'))->property('3', Schema::array(
        Schema::object()->property('0', Schema::string()->describe('Nested'))
      )->describe('Three')));
    $client = Tool::client('c', 'C')->param('0', Schema::string()->describe('Zero'));

    foreach ([$tool, $client] as $t) {
      $json = $t->toJsonString();
      $this->assertStringNotContainsString('": [', str_replace('"required": [', '', $json));
      // The request build() returns writes the maps as objects too. (Compared as raw JSON: PHP's
      // own decoding would turn `{"0": …}` back into a list.)
      $sent = (string) json_encode($t->build());
      $this->assertMatchesRegularExpression('/"(properties|path_params_schema)":\{"[0-3]":/', $sent);
      $this->assertDoesNotMatchRegularExpression('/"(properties|path_params_schema)":\[/', $sent);
    }
    $sent = (string) json_encode($tool->build());
    $this->assertStringContainsString('"path_params_schema":{"0":{', $sent);
    $this->assertStringContainsString('"query_params_schema":{"properties":{"1":{', $sent);
    $this->assertStringContainsString('"properties":{"0":{"type":"string","description":"Nested"', $sent);
    $this->assertSame($tool->toJsonString(), Tool::fromJson($tool->toJsonString())->toJsonString());
  }

  // PHP: a number constant must be finite.

  public function testNonFiniteNumberConstantsAreRejected(): void
  {
    foreach ([INF, -INF, NAN] as $value) {
      $tool = Tool::client('c', 'C')->param('n', Schema::number()->constant($value));
      $this->assertSame(['constant_type_mismatch'], $this->errors($tool));
    }
  }

  // PHP: generated models lose nested schemas, recovered when loading them.

  public function testFromResponseKeepsNestedSchemas(): void
  {
    $tool = $this->nestedTool();
    $response = ToolResponseModel::fromJson((string) json_encode([
      'id' => 'tool_123',
      'tool_config' => Wire::decodeJson($tool->toJsonString()),
      'access_info' => ['is_creator' => true, 'creator_name' => 'A', 'creator_email' => 'a@example.com', 'role' => 'admin'],
      'usage_stats' => ['avg_latency_secs' => 0.5],
    ]));

    $this->assertSame($tool->toJsonString(), Tool::fromResponse($response)->toJsonString());
    // Loading the generated request model goes the same way.
    $this->assertSame($tool->toJsonString(), Tool::fromJson($tool->build())->toJsonString());
  }

  // PHP: `{}` inside a container constant survives build().

  public function testEmptyObjectsInConstantsReachBuild(): void
  {
    $tool = Tool::client('c', 'C')
      ->param('empty', Schema::object()->constant(new \stdClass()))
      ->param('nested', Schema::object()->constant(['a' => new \stdClass(), 'b' => [new \stdClass()]]))
      ->param('list', Schema::array(Schema::string()->describe('S'))->constant([new \stdClass()]));

    $sent = (string) json_encode($tool->build());
    $this->assertStringContainsString('"empty":{"constant_value":{}', $sent);
    $this->assertStringContainsString('"constant_value":{"a":{},"b":[{}]}', $sent);
    $this->assertStringContainsString('"constant_value":[{}]', $sent);
    $this->assertSame(
      Wire::encode(Wire::canonical(Wire::decodeJson($sent)['tool_config'])),
      $tool->toJsonString()
    );
  }

  private function nestedTool(): Tool
  {
    return Tool::webhook('create_order', 'Create an order')
      ->post('https://api.example.com/orders')
      ->body(Schema::object()
        ->property('items', Schema::array(
          Schema::object()
            ->property('sku', Schema::string()->describe('Product SKU'))
            ->property('tags', Schema::array(Schema::string()->describe('A tag'))->describe('Tags'))
        )->describe('Line items'))
        ->property('address', Schema::object()->property('city', Schema::string()->describe('City'))));
  }

  private function webhook(): \ElevenLabs\AgentTools\WebhookTool
  {
    return Tool::webhook('w', 'W')->get('https://api.example.com');
  }

  /**
   * @param array<string, mixed> $config
   * @param array<string, mixed> $api
   * @return array<string, mixed>
   */
  private function webhookWire(array $config = [], array $api = []): array
  {
    return array_merge(
      [
        'type' => 'webhook',
        'name' => 'w',
        'description' => 'W',
        'api_schema' => array_merge(['method' => 'GET', 'url' => 'https://api.example.com'], $api),
      ],
      $config
    );
  }

  /**
   * @return list<ToolIssue>
   */
  private function issues(Tool $tool): array
  {
    try {
      $tool->toJson();
      return [];
    } catch (ToolValidationError $e) {
      return $e->issues;
    }
  }

  /**
   * @return list<string>
   */
  private function errors(Tool $tool): array
  {
    return array_map(static fn(ToolIssue $i): string => $i->code, $this->issues($tool));
  }
}
