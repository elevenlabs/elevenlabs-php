<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\McpServers\ToolConfigs;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ToolConfigsWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "config": {
              "approval_policy": "auto_approve_all",
              "tool_approval_hashes": [
                  {
                      "tool_name": "test-value",
                      "tool_hash": "test-value",
                      "approval_policy": "auto_approved"
                  }
              ],
              "transport": "SSE",
              "url": "test-value",
              "secret_token": {
                  "secret_id": "test-value"
              },
              "request_headers": {
                  "key": "test-value"
              },
              "request_meta": {
                  "key": "test-value"
              },
              "auth_connection": {
                  "auth_connection_id": "test-value"
              },
              "name": "test-value",
              "description": "test-value",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "execution_mode": "immediate",
              "response_timeout_secs": 5,
              "tool_config_overrides": [
                  {
                      "tool_name": "test-value",
                      "force_pre_tool_speech": true,
                      "pre_tool_speech": "auto",
                      "disable_interruptions": true,
                      "interruption_mode": "allow",
                      "tool_call_sound": "typing",
                      "tool_call_sound_behavior": "auto",
                      "execution_mode": "immediate",
                      "response_timeout_secs": 5,
                      "assignments": [
                          {
                              "source": "response",
                              "dynamic_variable": "test-value",
                              "value_path": "test-value",
                              "sanitize": true,
                              "preserve_native_type": true
                          }
                      ],
                      "input_overrides": {
                          "key": {
                              "source": "constant",
                              "constant_value": "test-value"
                          }
                      },
                      "response_mocks": [
                          {
                              "parameter_conditions": [
                                  {
                                      "eval": {
                                          "type": "llm",
                                          "description": "test-value"
                                      },
                                      "path": "test-value"
                                  }
                              ],
                              "mock_result": "test-value",
                              "is_error": true
                          }
                      ]
                  }
              ],
              "disable_compression": true
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "dependent_agents": [
              {
                  "referenced_resource_ids": [
                      "test-value"
                  ],
                  "id": "test-value",
                  "name": "test-value",
                  "type": "available",
                  "created_at_unix_secs": 1,
                  "access_level": "admin"
              }
          ],
          "metadata": {
              "created_at": 1,
              "owner_user_id": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $mcpToolConfigOverrideCreateRequestModelToolCallSound =
      \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => true,
      'preserveNativeType' => false
    ]);

    $constantSchemaOverrideSource = \ElevenLabs\Types\ConstantSchemaOverrideSource::Constant->value;

    $constantSchemaOverrideConstantValue = 'exercitatio';

    $constantSchemaOverride = new \ElevenLabs\Types\ConstantSchemaOverride([
      'source' => $constantSchemaOverrideSource,
      'constantValue' => $constantSchemaOverrideConstantValue
    ]);
    $mcpToolConfigOverrideCreateRequestModelInputOverridesValue = \ElevenLabs\Agents\McpServers\ToolConfigs\Types\McpToolConfigOverrideCreateRequestModelInputOverridesValue::constant(
      $constantSchemaOverride
    );

    $llmParameterEvaluationStrategyType =
      \ElevenLabs\Types\LlmParameterEvaluationStrategyType::Llm->value;

    $llmParameterEvaluationStrategy = new \ElevenLabs\Types\LlmParameterEvaluationStrategy([
      'type' => $llmParameterEvaluationStrategyType,
      'description' => 'description'
    ]);
    $unitTestToolCallParameterEval = \ElevenLabs\Types\UnitTestToolCallParameterEval::llm(
      $llmParameterEvaluationStrategy
    );

    $unitTestToolCallParameter = new \ElevenLabs\Types\UnitTestToolCallParameter([
      'eval' => $unitTestToolCallParameterEval,
      'path' => 'path'
    ]);

    $toolResponseMockConfigInput = new \ElevenLabs\Types\ToolResponseMockConfigInput([
      'parameterConditions' => [],
      'mockResult' => 'mock_result',
      'isError' => true
    ]);

    $request = new \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideCreateRequestModel(
      [
        'environment' => 'production',
        'forcePreToolSpeech' => false,
        'preToolSpeech' => $preToolSpeechMode,
        'disableInterruptions' => true,
        'interruptionMode' => $toolInterruptionMode,
        'toolCallSound' => $mcpToolConfigOverrideCreateRequestModelToolCallSound,
        'toolCallSoundBehavior' => $toolCallSoundBehavior,
        'executionMode' => $toolExecutionMode,
        'responseTimeoutSecs' => 266,
        'assignments' => [],
        'inputOverrides' => [],
        'responseMocks' => [],
        'toolName' => 'tool_name'
      ]
    );
    $sdk->agents->mcpServers->toolConfigs->create(request: $request, mcpServerId: 'mcp_server_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/mcp-servers/[^/]+/tool-configs$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "tool_name": "test-value",
          "force_pre_tool_speech": true,
          "pre_tool_speech": "auto",
          "disable_interruptions": true,
          "interruption_mode": "allow",
          "tool_call_sound": "typing",
          "tool_call_sound_behavior": "auto",
          "execution_mode": "immediate",
          "response_timeout_secs": 5,
          "assignments": [
              {
                  "source": "response",
                  "dynamic_variable": "test-value",
                  "value_path": "test-value",
                  "sanitize": true,
                  "preserve_native_type": true
              }
          ],
          "input_overrides": {
              "key": {
                  "source": "constant",
                  "constant_value": "test-value"
              }
          },
          "response_mocks": [
              {
                  "parameter_conditions": [
                      {
                          "eval": {
                              "type": "llm",
                              "description": "test-value"
                          },
                          "path": "test-value"
                      }
                  ],
                  "mock_result": "test-value",
                  "is_error": true
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->mcpServers->toolConfigs->get(mcpServerId: 'mcp_server_id', toolName: 'tool_name');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/mcp-servers/[^/]+/tool-configs/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "config": {
              "approval_policy": "auto_approve_all",
              "tool_approval_hashes": [
                  {
                      "tool_name": "test-value",
                      "tool_hash": "test-value",
                      "approval_policy": "auto_approved"
                  }
              ],
              "transport": "SSE",
              "url": "test-value",
              "secret_token": {
                  "secret_id": "test-value"
              },
              "request_headers": {
                  "key": "test-value"
              },
              "request_meta": {
                  "key": "test-value"
              },
              "auth_connection": {
                  "auth_connection_id": "test-value"
              },
              "name": "test-value",
              "description": "test-value",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "execution_mode": "immediate",
              "response_timeout_secs": 5,
              "tool_config_overrides": [
                  {
                      "tool_name": "test-value",
                      "force_pre_tool_speech": true,
                      "pre_tool_speech": "auto",
                      "disable_interruptions": true,
                      "interruption_mode": "allow",
                      "tool_call_sound": "typing",
                      "tool_call_sound_behavior": "auto",
                      "execution_mode": "immediate",
                      "response_timeout_secs": 5,
                      "assignments": [
                          {
                              "source": "response",
                              "dynamic_variable": "test-value",
                              "value_path": "test-value",
                              "sanitize": true,
                              "preserve_native_type": true
                          }
                      ],
                      "input_overrides": {
                          "key": {
                              "source": "constant",
                              "constant_value": "test-value"
                          }
                      },
                      "response_mocks": [
                          {
                              "parameter_conditions": [
                                  {
                                      "eval": {
                                          "type": "llm",
                                          "description": "test-value"
                                      },
                                      "path": "test-value"
                                  }
                              ],
                              "mock_result": "test-value",
                              "is_error": true
                          }
                      ]
                  }
              ],
              "disable_compression": true
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "dependent_agents": [
              {
                  "referenced_resource_ids": [
                      "test-value"
                  ],
                  "id": "test-value",
                  "name": "test-value",
                  "type": "available",
                  "created_at_unix_secs": 1,
                  "access_level": "admin"
              }
          ],
          "metadata": {
              "created_at": 1,
              "owner_user_id": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $mcpToolConfigOverrideUpdateRequestModelToolCallSound =
      \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => true,
      'preserveNativeType' => false
    ]);

    $constantSchemaOverrideSource = \ElevenLabs\Types\ConstantSchemaOverrideSource::Constant->value;

    $constantSchemaOverrideConstantValue = 'exercitatio';

    $constantSchemaOverride = new \ElevenLabs\Types\ConstantSchemaOverride([
      'source' => $constantSchemaOverrideSource,
      'constantValue' => $constantSchemaOverrideConstantValue
    ]);
    $mcpToolConfigOverrideUpdateRequestModelInputOverridesValue = \ElevenLabs\Agents\McpServers\ToolConfigs\Types\McpToolConfigOverrideUpdateRequestModelInputOverridesValue::constant(
      $constantSchemaOverride
    );

    $llmParameterEvaluationStrategyType =
      \ElevenLabs\Types\LlmParameterEvaluationStrategyType::Llm->value;

    $llmParameterEvaluationStrategy = new \ElevenLabs\Types\LlmParameterEvaluationStrategy([
      'type' => $llmParameterEvaluationStrategyType,
      'description' => 'description'
    ]);
    $unitTestToolCallParameterEval = \ElevenLabs\Types\UnitTestToolCallParameterEval::llm(
      $llmParameterEvaluationStrategy
    );

    $unitTestToolCallParameter = new \ElevenLabs\Types\UnitTestToolCallParameter([
      'eval' => $unitTestToolCallParameterEval,
      'path' => 'path'
    ]);

    $toolResponseMockConfigInput = new \ElevenLabs\Types\ToolResponseMockConfigInput([
      'parameterConditions' => [],
      'mockResult' => 'mock_result',
      'isError' => true
    ]);

    $request = new \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideUpdateRequestModel(
      [
        'environment' => 'production',
        'forcePreToolSpeech' => true,
        'preToolSpeech' => $preToolSpeechMode,
        'disableInterruptions' => true,
        'interruptionMode' => $toolInterruptionMode,
        'toolCallSound' => $mcpToolConfigOverrideUpdateRequestModelToolCallSound,
        'toolCallSoundBehavior' => $toolCallSoundBehavior,
        'executionMode' => $toolExecutionMode,
        'responseTimeoutSecs' => 49,
        'assignments' => [],
        'inputOverrides' => [],
        'responseMocks' => []
      ]
    );
    $sdk->agents->mcpServers->toolConfigs->update(
      request: $request,
      mcpServerId: 'mcp_server_id',
      toolName: 'tool_name'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/mcp-servers/[^/]+/tool-configs/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "config": {
              "approval_policy": "auto_approve_all",
              "tool_approval_hashes": [
                  {
                      "tool_name": "test-value",
                      "tool_hash": "test-value",
                      "approval_policy": "auto_approved"
                  }
              ],
              "transport": "SSE",
              "url": "test-value",
              "secret_token": {
                  "secret_id": "test-value"
              },
              "request_headers": {
                  "key": "test-value"
              },
              "request_meta": {
                  "key": "test-value"
              },
              "auth_connection": {
                  "auth_connection_id": "test-value"
              },
              "name": "test-value",
              "description": "test-value",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "execution_mode": "immediate",
              "response_timeout_secs": 5,
              "tool_config_overrides": [
                  {
                      "tool_name": "test-value",
                      "force_pre_tool_speech": true,
                      "pre_tool_speech": "auto",
                      "disable_interruptions": true,
                      "interruption_mode": "allow",
                      "tool_call_sound": "typing",
                      "tool_call_sound_behavior": "auto",
                      "execution_mode": "immediate",
                      "response_timeout_secs": 5,
                      "assignments": [
                          {
                              "source": "response",
                              "dynamic_variable": "test-value",
                              "value_path": "test-value",
                              "sanitize": true,
                              "preserve_native_type": true
                          }
                      ],
                      "input_overrides": {
                          "key": {
                              "source": "constant",
                              "constant_value": "test-value"
                          }
                      },
                      "response_mocks": [
                          {
                              "parameter_conditions": [
                                  {
                                      "eval": {
                                          "type": "llm",
                                          "description": "test-value"
                                      },
                                      "path": "test-value"
                                  }
                              ],
                              "mock_result": "test-value",
                              "is_error": true
                          }
                      ]
                  }
              ],
              "disable_compression": true
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "dependent_agents": [
              {
                  "referenced_resource_ids": [
                      "test-value"
                  ],
                  "id": "test-value",
                  "name": "test-value",
                  "type": "available",
                  "created_at_unix_secs": 1,
                  "access_level": "admin"
              }
          ],
          "metadata": {
              "created_at": 1,
              "owner_user_id": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->mcpServers->toolConfigs->delete(
      mcpServerId: 'mcp_server_id',
      toolName: 'tool_name'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/mcp-servers/[^/]+/tool-configs/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  /**
   * @return ClientInterface&object{requests: list<RequestInterface>}
   */
  private function transport(int $status, string $body): ClientInterface
  {
    return new class ($status, $body) implements ClientInterface {
      /** @var list<RequestInterface> */
      public array $requests = [];

      public function __construct(private int $status, private string $body)
      {
      }

      public function sendRequest(RequestInterface $request): ResponseInterface
      {
        $this->requests[] = $request;

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}
