<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WebhookToolApiSchemaConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
            "property_kind": "array",
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
            "property_kind": "array",
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
    }
    JSON;

    $instance = \ElevenLabs\Types\WebhookToolApiSchemaConfigInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
