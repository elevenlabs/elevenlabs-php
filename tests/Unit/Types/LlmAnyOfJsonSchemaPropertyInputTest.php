<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmAnyOfJsonSchemaPropertyInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "any_of": [
            {
                "type": "object",
                "required": [
                    "test-value"
                ],
                "description": "test-value",
                "properties": {
                    "key": {
                        "type": "boolean",
                        "description": "test-value",
                        "enum": [
                            "test-value"
                        ]
                    }
                }
            }
        ],
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
