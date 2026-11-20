<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmObjectJsonSchemaPropertyOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
