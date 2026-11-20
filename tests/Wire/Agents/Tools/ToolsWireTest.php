<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Tools;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ToolsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "tools": [
              {
                  "id": "test-value",
                  "tool_config": {
                      "type": "webhook",
                      "name": "test-value",
                      "description": "test-value",
                      "response_timeout_secs": 5,
                      "disable_interruptions": true,
                      "interruption_mode": "allow",
                      "force_pre_tool_speech": true,
                      "pre_tool_speech": "auto",
                      "assignments": [
                          {
                              "source": "response",
                              "dynamic_variable": "test-value",
                              "value_path": "test-value",
                              "sanitize": true,
                              "preserve_native_type": true
                          }
                      ],
                      "tool_call_sound": "typing",
                      "tool_call_sound_behavior": "auto",
                      "tool_error_handling_mode": "auto",
                      "dynamic_variables": {
                          "dynamic_variable_placeholders": {
                              "key": "test-value"
                          }
                      },
                      "execution_mode": "immediate",
                      "api_schema": {
                          "request_headers": {
                              "key": "test-value"
                          },
                          "url": "test-value",
                          "method": "GET",
                          "path_params_schema": {
                              "key": {
                                  "type": "boolean",
                                  "description": "test-value",
                                  "enum": [
                                      "test-value"
                                  ],
                                  "is_system_provided": true,
                                  "dynamic_variable": "test-value",
                                  "allowed_values": {
                                      "dynamic_variable": "test-value"
                                  },
                                  "allowed_values_dynamic_variable": "test-value",
                                  "constant_value": "test-value",
                                  "is_omitted": true
                              }
                          },
                          "query_params_schema": {
                              "properties": {
                                  "key": {
                                      "type": "boolean",
                                      "description": "test-value",
                                      "enum": [
                                          "test-value"
                                      ],
                                      "is_system_provided": true,
                                      "dynamic_variable": "test-value",
                                      "allowed_values": {
                                          "dynamic_variable": "test-value"
                                      },
                                      "allowed_values_dynamic_variable": "test-value",
                                      "constant_value": "test-value",
                                      "is_omitted": true
                                  }
                              },
                              "required": [
                                  "test-value"
                              ]
                          },
                          "request_body_schema": {
                              "description": "test-value",
                              "dynamic_variable": "test-value",
                              "constant_value": {
                                  "key": "test-value"
                              },
                              "is_omitted": true,
                              "type": "object",
                              "required": [
                                  "test-value"
                              ],
                              "properties": {
                                  "key": {
                                      "type": "boolean",
                                      "description": "test-value",
                                      "enum": [
                                          "test-value"
                                      ],
                                      "is_system_provided": true,
                                      "dynamic_variable": "test-value",
                                      "allowed_values": {
                                          "dynamic_variable": "test-value"
                                      },
                                      "allowed_values_dynamic_variable": "test-value",
                                      "constant_value": "test-value",
                                      "is_omitted": true
                                  }
                              },
                              "required_constraints": {
                                  "any_of": [
                                      {
                                          "required": [
                                              "test-value"
                                          ]
                                      }
                                  ],
                                  "all_of": [
                                      {
                                          "required": [
                                              "test-value"
                                          ]
                                      }
                                  ]
                              }
                          },
                          "response_body_schema": {
                              "description": "test-value",
                              "dynamic_variable": "test-value",
                              "constant_value": {
                                  "key": "test-value"
                              },
                              "is_omitted": true,
                              "type": "object",
                              "required": [
                                  "test-value"
                              ],
                              "properties": {
                                  "key": {
                                      "type": "boolean",
                                      "description": "test-value",
                                      "enum": [
                                          "test-value"
                                      ],
                                      "is_system_provided": true,
                                      "dynamic_variable": "test-value",
                                      "allowed_values": {
                                          "dynamic_variable": "test-value"
                                      },
                                      "allowed_values_dynamic_variable": "test-value",
                                      "constant_value": "test-value",
                                      "is_omitted": true
                                  }
                              },
                              "required_constraints": {
                                  "any_of": [
                                      {
                                          "required": [
                                              "test-value"
                                          ]
                                      }
                                  ],
                                  "all_of": [
                                      {
                                          "required": [
                                              "test-value"
                                          ]
                                      }
                                  ]
                              }
                          },
                          "response_filter": {
                              "mode": "all",
                              "filters": [
                                  "test-value"
                              ],
                              "content_type": "application/json"
                          },
                          "content_type": "application/json",
                          "auth_resolved_params": [
                              "test-value"
                          ],
                          "auth_connection": {
                              "auth_connection_id": "test-value"
                          }
                      },
                      "follow_redirects": true,
                      "follow_redirects_allowed_domains": [
                          "test-value"
                      ]
                  },
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "usage_stats": {
                      "total_calls": 1,
                      "avg_latency_secs": 1
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
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sortBy = \ElevenLabs\Types\ToolSortBy::Name;
    $sdk->agents->tools->list(
      request: new \ElevenLabs\Agents\Tools\Requests\ListToolsRequest([
        'search' => 'search',
        'pageSize' => 6,
        'showOnlyOwnedDocuments' => false,
        'createdByUserId' => 'created_by_user_id',
        'types' => [],
        'sortDirection' => $sortDirection->value,
        'sortBy' => $sortBy->value,
        'usedByAgentId' => 'used_by_agent_id',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "tool_config": {
              "type": "webhook",
              "name": "test-value",
              "description": "test-value",
              "response_timeout_secs": 5,
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "assignments": [
                  {
                      "source": "response",
                      "dynamic_variable": "test-value",
                      "value_path": "test-value",
                      "sanitize": true,
                      "preserve_native_type": true
                  }
              ],
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "tool_error_handling_mode": "auto",
              "dynamic_variables": {
                  "dynamic_variable_placeholders": {
                      "key": "test-value"
                  }
              },
              "execution_mode": "immediate",
              "api_schema": {
                  "request_headers": {
                      "key": "test-value"
                  },
                  "url": "test-value",
                  "method": "GET",
                  "path_params_schema": {
                      "key": {
                          "type": "boolean",
                          "description": "test-value",
                          "enum": [
                              "test-value"
                          ],
                          "is_system_provided": true,
                          "dynamic_variable": "test-value",
                          "allowed_values": {
                              "dynamic_variable": "test-value"
                          },
                          "allowed_values_dynamic_variable": "test-value",
                          "constant_value": "test-value",
                          "is_omitted": true
                      }
                  },
                  "query_params_schema": {
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required": [
                          "test-value"
                      ]
                  },
                  "request_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_filter": {
                      "mode": "all",
                      "filters": [
                          "test-value"
                      ],
                      "content_type": "application/json"
                  },
                  "content_type": "application/json",
                  "auth_resolved_params": [
                      "test-value"
                  ],
                  "auth_connection": {
                      "auth_connection_id": "test-value"
                  }
              },
              "follow_redirects": true,
              "follow_redirects_allowed_domains": [
                  "test-value"
              ]
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "usage_stats": {
              "total_calls": 1,
              "avg_latency_secs": 1
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
    $webhookToolConfigInputType = \ElevenLabs\Types\WebhookToolConfigInputType::Webhook->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigInputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigInputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigInputMethod::Get->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = []; // TODO: populate with required fields

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaInputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaInput = new \ElevenLabs\Types\QueryParamsJsonSchemaInput([
      'properties' => [],
      'required' => []
    ]);

    $objectJsonSchemaPropertyInputPropertyKind =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyInputPropertyKind::Array->value;

    $objectJsonSchemaPropertyInputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyInputType::Object->value;

    $objectJsonSchemaPropertyInputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyInput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyInput([
      'propertyKind' => $objectJsonSchemaPropertyInputPropertyKind,
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => true,
      'type' => $objectJsonSchemaPropertyInputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigInputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigInputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigInputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigInput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigInput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigInputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaInput,
      'requestBodySchema' => $objectJsonSchemaPropertyInput,
      'responseBodySchema' => $objectJsonSchemaPropertyInput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigInputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigInputAuthConnection
    ]);

    $webhookToolConfigInput = new \ElevenLabs\Types\WebhookToolConfigInput([
      'type' => $webhookToolConfigInputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => false,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => false,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigInput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $toolRequestModelToolConfig = \ElevenLabs\Types\ToolRequestModelToolConfig::webhook(
      $webhookToolConfigInput
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
      'isError' => false
    ]);

    $request = new \ElevenLabs\Types\ToolRequestModel([
      'toolConfig' => $toolRequestModelToolConfig,
      'responseMocks' => []
    ]);
    $sdk->agents->tools->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools$#',
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
          "id": "test-value",
          "tool_config": {
              "type": "webhook",
              "name": "test-value",
              "description": "test-value",
              "response_timeout_secs": 5,
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "assignments": [
                  {
                      "source": "response",
                      "dynamic_variable": "test-value",
                      "value_path": "test-value",
                      "sanitize": true,
                      "preserve_native_type": true
                  }
              ],
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "tool_error_handling_mode": "auto",
              "dynamic_variables": {
                  "dynamic_variable_placeholders": {
                      "key": "test-value"
                  }
              },
              "execution_mode": "immediate",
              "api_schema": {
                  "request_headers": {
                      "key": "test-value"
                  },
                  "url": "test-value",
                  "method": "GET",
                  "path_params_schema": {
                      "key": {
                          "type": "boolean",
                          "description": "test-value",
                          "enum": [
                              "test-value"
                          ],
                          "is_system_provided": true,
                          "dynamic_variable": "test-value",
                          "allowed_values": {
                              "dynamic_variable": "test-value"
                          },
                          "allowed_values_dynamic_variable": "test-value",
                          "constant_value": "test-value",
                          "is_omitted": true
                      }
                  },
                  "query_params_schema": {
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required": [
                          "test-value"
                      ]
                  },
                  "request_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_filter": {
                      "mode": "all",
                      "filters": [
                          "test-value"
                      ],
                      "content_type": "application/json"
                  },
                  "content_type": "application/json",
                  "auth_resolved_params": [
                      "test-value"
                  ],
                  "auth_connection": {
                      "auth_connection_id": "test-value"
                  }
              },
              "follow_redirects": true,
              "follow_redirects_allowed_domains": [
                  "test-value"
              ]
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "usage_stats": {
              "total_calls": 1,
              "avg_latency_secs": 1
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
    $sdk->agents->tools->get(
      request: new \ElevenLabs\Agents\Tools\Requests\GetToolsRequest([
        'environment' => 'production'
      ]),
      toolId: 'tool_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools/[^/]+$#',
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
          "tool_config": {
              "type": "webhook",
              "name": "test-value",
              "description": "test-value",
              "response_timeout_secs": 5,
              "disable_interruptions": true,
              "interruption_mode": "allow",
              "force_pre_tool_speech": true,
              "pre_tool_speech": "auto",
              "assignments": [
                  {
                      "source": "response",
                      "dynamic_variable": "test-value",
                      "value_path": "test-value",
                      "sanitize": true,
                      "preserve_native_type": true
                  }
              ],
              "tool_call_sound": "typing",
              "tool_call_sound_behavior": "auto",
              "tool_error_handling_mode": "auto",
              "dynamic_variables": {
                  "dynamic_variable_placeholders": {
                      "key": "test-value"
                  }
              },
              "execution_mode": "immediate",
              "api_schema": {
                  "request_headers": {
                      "key": "test-value"
                  },
                  "url": "test-value",
                  "method": "GET",
                  "path_params_schema": {
                      "key": {
                          "type": "boolean",
                          "description": "test-value",
                          "enum": [
                              "test-value"
                          ],
                          "is_system_provided": true,
                          "dynamic_variable": "test-value",
                          "allowed_values": {
                              "dynamic_variable": "test-value"
                          },
                          "allowed_values_dynamic_variable": "test-value",
                          "constant_value": "test-value",
                          "is_omitted": true
                      }
                  },
                  "query_params_schema": {
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required": [
                          "test-value"
                      ]
                  },
                  "request_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_body_schema": {
                      "description": "test-value",
                      "dynamic_variable": "test-value",
                      "constant_value": {
                          "key": "test-value"
                      },
                      "is_omitted": true,
                      "type": "object",
                      "required": [
                          "test-value"
                      ],
                      "properties": {
                          "key": {
                              "type": "boolean",
                              "description": "test-value",
                              "enum": [
                                  "test-value"
                              ],
                              "is_system_provided": true,
                              "dynamic_variable": "test-value",
                              "allowed_values": {
                                  "dynamic_variable": "test-value"
                              },
                              "allowed_values_dynamic_variable": "test-value",
                              "constant_value": "test-value",
                              "is_omitted": true
                          }
                      },
                      "required_constraints": {
                          "any_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ],
                          "all_of": [
                              {
                                  "required": [
                                      "test-value"
                                  ]
                              }
                          ]
                      }
                  },
                  "response_filter": {
                      "mode": "all",
                      "filters": [
                          "test-value"
                      ],
                      "content_type": "application/json"
                  },
                  "content_type": "application/json",
                  "auth_resolved_params": [
                      "test-value"
                  ],
                  "auth_connection": {
                      "auth_connection_id": "test-value"
                  }
              },
              "follow_redirects": true,
              "follow_redirects_allowed_domains": [
                  "test-value"
              ]
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "usage_stats": {
              "total_calls": 1,
              "avg_latency_secs": 1
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
    $webhookToolConfigInputType = \ElevenLabs\Types\WebhookToolConfigInputType::Webhook->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigInputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigInputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigInputMethod::Get->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = []; // TODO: populate with required fields

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaInputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaInput = new \ElevenLabs\Types\QueryParamsJsonSchemaInput([
      'properties' => [],
      'required' => []
    ]);

    $objectJsonSchemaPropertyInputPropertyKind =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyInputPropertyKind::Array->value;

    $objectJsonSchemaPropertyInputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyInputType::Object->value;

    $objectJsonSchemaPropertyInputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyInput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyInput([
      'propertyKind' => $objectJsonSchemaPropertyInputPropertyKind,
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => true,
      'type' => $objectJsonSchemaPropertyInputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigInputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigInputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigInputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigInput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigInput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigInputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaInput,
      'requestBodySchema' => $objectJsonSchemaPropertyInput,
      'responseBodySchema' => $objectJsonSchemaPropertyInput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigInputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigInputAuthConnection
    ]);

    $webhookToolConfigInput = new \ElevenLabs\Types\WebhookToolConfigInput([
      'type' => $webhookToolConfigInputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => false,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => false,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigInput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $toolRequestModelToolConfig = \ElevenLabs\Types\ToolRequestModelToolConfig::webhook(
      $webhookToolConfigInput
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
      'isError' => false
    ]);

    $request = new \ElevenLabs\Types\ToolRequestModel([
      'toolConfig' => $toolRequestModelToolConfig,
      'responseMocks' => []
    ]);
    $sdk->agents->tools->update(request: $request, toolId: 'tool_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools/[^/]+$#',
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
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tools->delete(
      request: new \ElevenLabs\Agents\Tools\Requests\DeleteToolsRequest([
        'force' => false
      ]),
      toolId: 'tool_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetDependentAgentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agents": [
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
          "branches": [
              {
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "branch_id": "test-value",
                  "branch_name": "test-value",
                  "is_main": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tools->getDependentAgents(
      request: new \ElevenLabs\Agents\Tools\Requests\GetDependentAgentsToolsRequest([
        'cursor' => 'cursor',
        'pageSize' => 30
      ]),
      toolId: 'tool_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools/[^/]+/dependent-agents$#',
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
