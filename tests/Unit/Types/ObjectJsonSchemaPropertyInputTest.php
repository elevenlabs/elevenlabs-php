<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ObjectJsonSchemaPropertyInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\ObjectJsonSchemaPropertyInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
