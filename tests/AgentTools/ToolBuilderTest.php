<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentTools;

use ElevenLabs\AgentTools\ArraySchema;
use ElevenLabs\AgentTools\AuthConnection;
use ElevenLabs\AgentTools\ClientTool;
use ElevenLabs\AgentTools\Header;
use ElevenLabs\AgentTools\LiteralSchema;
use ElevenLabs\AgentTools\ObjectSchema;
use ElevenLabs\AgentTools\Schema;
use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentTools\ToolIssue;
use ElevenLabs\AgentTools\ToolValidationError;
use ElevenLabs\AgentTools\WebhookTool;
use ElevenLabs\AgentWorkflows\Destination;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Types\BuiltInToolsInput;
use ElevenLabs\Types\ClientToolConfigInput;
use ElevenLabs\Types\PreToolSpeechMode;
use ElevenLabs\Types\SystemToolConfigInput;
use ElevenLabs\Types\ToolRequestModel;
use ElevenLabs\Types\ToolResponseModel;
use ElevenLabs\Types\WebhookToolConfigInput;
use PHPUnit\Framework\TestCase;

class ToolBuilderTest extends TestCase
{
  public function testBuildReturnsGeneratedRequestModel(): void
  {
    $model = $this->getOrder()->build();

    $this->assertInstanceOf(ToolRequestModel::class, $model);
    $this->assertTrue($model->toolConfig->isWebhook());
    $model->validate();
    $config = $model->toolConfig->asWebhook();
    $this->assertSame('get_order', $config->name);
    $this->assertSame('GET', $config->apiSchema->method);
  }

  public function testBuildKeepsNestedSchemas(): void
  {
    // The generated deserializer reads a nested schema as a literal, which would drop `items` and
    // nested `properties`; build() must send them.
    $tool = Tool::webhook('create_order', 'Create an order')
      ->post('https://api.example.com/orders')
      ->body(Schema::object()
        ->property('items', Schema::array(
          Schema::object()
            ->property('sku', Schema::string()->describe('Product SKU'))
            ->property('tags', Schema::array(Schema::string()->describe('A tag'))->describe('Tags'))
        )->describe('Line items'))
        ->property('address', Schema::object()->property('city', Schema::string()->describe('City'))));
    $client = Tool::client('show', 'Show things')
      ->param('list', Schema::array(Schema::string()->describe('One'))->describe('Things'));

    foreach ([$tool, $client] as $t) {
      $sent = Wire::encode(Wire::canonical(Wire::toWire($t->build())['tool_config']));
      $this->assertSame($t->toJsonString(), $sent);
    }
  }

  public function testBuildConfigReturnsTheConfigModelForEachKind(): void
  {
    $this->assertInstanceOf(WebhookToolConfigInput::class, $this->getOrder()->buildConfig());
    $this->assertInstanceOf(
      ClientToolConfigInput::class,
      Tool::client('ping', 'Ping the client')->buildConfig()
    );

    $endCall = SystemTool::endCall()->buildConfig();
    $this->assertInstanceOf(SystemToolConfigInput::class, $endCall);
    $builtIn = new BuiltInToolsInput(['endCall' => $endCall]);
    $this->assertSame(
      ['end_call' => ['type' => 'system', 'name' => 'end_call', 'params' => ['system_tool_type' => 'end_call']]],
      Wire::toWire($builtIn)
    );
  }

  public function testToJsonStringIsCanonical(): void
  {
    $json = $this->getOrder()->toJsonString();

    $this->assertStringEndsWith("}\n", $json);
    $this->assertStringStartsWith("{\n  \"api_schema\": {\n    \"method\": \"GET\",", $json);
    $this->assertSame($json, Tool::fromJson($json)->toJsonString());
  }

  public function testValidationErrorListsEveryProblem(): void
  {
    $tool = Tool::webhook('broken', 'Broken')
      ->post('https://api.example.com/{id}')
      ->queryParam('q', Schema::string());

    try {
      $tool->build();
      $this->fail('Expected ToolValidationError');
    } catch (ToolValidationError $e) {
      $codes = array_map(static fn(ToolIssue $i): string => $i->code, $e->issues);
      $this->assertSame(['missing_path_param', 'missing_value_source', 'missing_body'], $codes);
      $this->assertSame('pathParams.id', $e->issues[0]->path);
      $this->assertSame('query.q', $e->issues[1]->path);
      $this->assertStringStartsWith("Invalid tool \"broken\":\n  - The URL has {id} but no pathParam(\"id\")", $e->getMessage());
    }
  }

  public function testUnknownToolTypeRoundTripsWithAWarning(): void
  {
    $raw = ['type' => 'mcp', 'name' => 'search', 'description' => 'Search', 'mcp_server_id' => 'mcp_1'];
    $tool = Tool::fromJson($raw);

    $this->assertSame('other', $tool->kind());
    $this->assertNull($tool->asWebhook());
    $this->assertNull($tool->asClient());
    $this->assertNull($tool->asSystem());

    $warnings = [];
    $model = $tool->build(function (ToolIssue $issue) use (&$warnings): void {
      $warnings[] = $issue->code;
    });
    $this->assertSame(['unknown_tool_type'], $warnings);
    $this->assertTrue($model->toolConfig->isMcp());
    $this->assertSame(Wire::canonical($raw), $tool->toJson());
  }

  public function testOptionsThatDontApplyAreReported(): void
  {
    $tool = SystemTool::endCall()->options(expectsResponse: true, contentType: 'application/json');

    try {
      $tool->toJson();
      $this->fail('Expected ToolValidationError');
    } catch (ToolValidationError $e) {
      $this->assertSame(
        ['contentType', 'expectsResponse'],
        array_map(static fn(ToolIssue $i): ?string => $i->path, $e->issues)
      );
    }
  }

  public function testOptionsAcceptGeneratedEnums(): void
  {
    $json = Tool::client('ping', 'Ping')
      ->options(preToolSpeech: PreToolSpeechMode::Force, name: 'ping_client')
      ->toJson();

    $this->assertSame('force', $json['pre_tool_speech']);
    $this->assertSame('ping_client', $json['name']);
  }

  public function testKindsAndNarrowing(): void
  {
    $webhook = Tool::fromJson($this->getOrder()->toJsonString());
    $this->assertSame('webhook', $webhook->kind());
    $this->assertInstanceOf(WebhookTool::class, $webhook->asWebhook());
    $this->assertNull($webhook->asClient());

    $client = Tool::fromJson(['tool_config' => ['type' => 'client', 'name' => 'c', 'description' => 'C']]);
    $this->assertInstanceOf(ClientTool::class, $client->asClient());

    $system = Tool::fromJson('{"type":"system","name":"end_call","params":{"system_tool_type":"end_call"}}');
    $this->assertSame('end_call', $system->asSystem()?->systemToolType());
  }

  public function testFromResponse(): void
  {
    $response = ToolResponseModel::fromJson((string) json_encode([
      'id' => 'tool_123',
      'tool_config' => json_decode($this->getOrder()->toJsonString(), true),
      'access_info' => ['is_creator' => true, 'creator_name' => 'A', 'creator_email' => 'a@example.com', 'role' => 'admin'],
      'usage_stats' => ['avg_latency_secs' => 0.5],
    ]));

    $tool = Tool::fromResponse($response);
    $this->assertSame('get_order', $tool->name());
    $this->assertSame($this->getOrder()->toJsonString(), $tool->toJsonString());
  }

  public function testLoadedNullsAreUnset(): void
  {
    $tool = Tool::fromJson([
      'type' => 'client',
      'name' => 'c',
      'description' => 'C',
      'response_timeout_secs' => null,
      'parameters' => [
        'type' => 'object',
        'properties' => [
          'n' => ['type' => ['integer', 'null'], 'constant_value' => null, 'description' => null],
        ],
        'required' => ['n'],
      ],
    ]);

    // A `null` constant on a nullable literal is a real constant, and the rest of the nulls drop.
    $this->assertSame(
      ['description' => 'C', 'name' => 'c', 'parameters' => [
        'properties' => ['n' => ['constant_value' => null, 'type' => ['integer', 'null']]],
        'required' => ['n'],
        'type' => 'object',
      ], 'type' => 'client'],
      $tool->toJson()
    );
  }

  public function testSchemasAreValues(): void
  {
    $id = Schema::string()->describe('An id');
    $optional = $id->optional();

    $this->assertFalse($id->isOptional());
    $this->assertTrue($optional->isOptional());
    $this->assertInstanceOf(LiteralSchema::class, $optional);

    $object = Schema::object()->property('a', $id);
    $withB = $object->property('b', $optional);
    $this->assertSame(['a'], $object->propertyNames());
    $this->assertSame(['a', 'b'], $withB->propertyNames());
    $this->assertSame(['a'], $withB->without('b')->propertyNames());
    $this->assertSame($optional, $withB->propertySchema('b'));
    $this->assertNull($withB->propertySchema('missing'));
    $this->assertInstanceOf(ObjectSchema::class, $withB->describe('An object'));

    $list = Schema::array($id);
    $this->assertInstanceOf(ArraySchema::class, $list);
    $this->assertSame($id, $list->items());
    $this->assertSame('array', $list->kind());
    $this->assertSame('boolean', Schema::bool()->kind());
  }

  public function testEditLoadedBodySchema(): void
  {
    $tool = Tool::fromJson(Tool::webhook('refund', 'Refund an order')
      ->delete('https://api.example.com/refunds/{id}')
      ->pathParam('id', Schema::string()->fromVariable('refund_id'))
      ->body(Schema::object()->property('reason', Schema::string()->describe('Why')))
      ->header('X-Static', Header::value('1'))
      ->header('X-Other', Header::envVar('other'))
      ->auth(AuthConnection::envVar('refunds_oauth'))
      ->assign('a', 'x.a')
      ->assign('b', 'x.b')
      ->toJsonString())->asWebhook();
    $this->assertNotNull($tool);

    /** @var ObjectSchema $body */
    $body = $tool->bodySchema();
    $tool->body($body->property('note', Schema::string()->describe('Note')->optional()))
      ->removeHeader('X-Other')
      ->removeAssignment('a')
      ->removePathParam('missing');

    $json = $tool->toJson();
    $this->assertSame('DELETE', $json['api_schema']['method']);
    $this->assertSame(['X-Static' => '1'], $json['api_schema']['request_headers']);
    $this->assertSame(['env_var_label' => 'refunds_oauth'], $json['api_schema']['auth_connection']);
    $this->assertSame(['reason'], $json['api_schema']['request_body_schema']['required']);
    $this->assertSame(['note', 'reason'], array_keys($json['api_schema']['request_body_schema']['properties']));
    $this->assertSame([['dynamic_variable' => 'b', 'source' => 'response', 'value_path' => 'x.b']], $json['assignments']);
  }

  public function testDeleteNeedsNoBody(): void
  {
    $json = Tool::webhook('cancel', 'Cancel an order')->delete('https://api.example.com/orders')->toJson();
    $this->assertSame('DELETE', $json['api_schema']['method']);
  }

  public function testClientParamsCanBeRemoved(): void
  {
    $tool = Tool::client('show', 'Show')
      ->param('a', Schema::string()->describe('A'))
      ->param('b', Schema::integer()->describe('B'))
      ->removeParam('a');

    $this->assertSame(['b'], $tool->parametersSchema()?->propertyNames());
  }

  public function testTransferOnlyAppliesToTransferTools(): void
  {
    $tool = SystemTool::endCall()->transfer('Caller asks', Destination::phone('+15551234567'));
    $this->expectException(ToolValidationError::class);
    $tool->build();
  }

  public function testSipVariableTransferWithSipRefer(): void
  {
    $json = SystemTool::transferToNumber()
      ->transfer('Caller asks for a manager', Destination::sipVariable('manager_sip'), transferType: 'sip_refer')
      ->toJson();

    $this->assertSame(
      [[
        'condition' => 'Caller asks for a manager',
        'transfer_destination' => ['sip_uri' => 'manager_sip', 'type' => 'sip_uri_dynamic_variable'],
        'transfer_type' => 'sip_refer',
      ]],
      $json['params']['transfers']
    );
  }

  public function testAgentTransferRejectsPhoneOptions(): void
  {
    $tool = SystemTool::transferToAgent()
      ->transfer('Caller wants sales', Destination::agent('agent_sales'), transferType: 'conference');

    try {
      $tool->build();
      $this->fail('Expected ToolValidationError');
    } catch (ToolValidationError $e) {
      $this->assertSame(['invalid_option'], array_map(static fn(ToolIssue $i): string => $i->code, $e->issues));
      $this->assertSame('transferType', $e->issues[0]->path);
    }
  }

  public function testSystemToolConstructorsSetParams(): void
  {
    $this->assertSame(
      ['suppress_turn_after_dtmf' => true, 'system_tool_type' => 'play_keypad_touch_tone'],
      SystemTool::playKeypadTouchTone(suppressTurnAfterDtmf: true)->toJson()['params']
    );
    $this->assertSame(
      ['system_tool_type' => 'voicemail_detection', 'voicemail_message' => 'Call me back'],
      SystemTool::voicemailDetection('Call me back')->toJson()['params']
    );
    $this->assertSame(
      ['only_at_conversation_start' => true, 'system_tool_type' => 'language_detection'],
      SystemTool::languageDetection(onlyAtConversationStart: true)->toJson()['params']
    );
  }

  public function testClientTimeoutRules(): void
  {
    $codes = static function (ClientTool $tool): array {
      try {
        $tool->build();
        return [];
      } catch (ToolValidationError $e) {
        return array_map(static fn(ToolIssue $i): string => $i->code, $e->issues);
      }
    };

    $this->assertSame([], $codes(Tool::client('a', 'A')->options(responseTimeoutSecs: 120)));
    $this->assertSame(['invalid_option'], $codes(Tool::client('a', 'A')->options(responseTimeoutSecs: 121)));
    $this->assertSame(['invalid_option'], $codes(Tool::client('a', 'A')->options(responseTimeoutSecs: -1)));
  }

  private function getOrder(): WebhookTool
  {
    return Tool::webhook('get_order', 'Look up an order by the number the caller gives')
      ->get('https://api.example.com/orders/{order_id}')
      ->pathParam('order_id', Schema::string()->describe('The order number, e.g. A-1042'))
      ->queryParam('include', Schema::string()->constant('items'))
      ->header('Authorization', Header::secret('sec_orders_api'))
      ->header('X-Caller', Header::variable('system__caller_id'))
      ->assign('order_status', 'order.status')
      ->options(responseTimeoutSecs: 10, preToolSpeech: 'force');
  }
}
