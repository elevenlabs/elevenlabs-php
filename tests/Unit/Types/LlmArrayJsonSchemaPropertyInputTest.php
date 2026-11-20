<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmArrayJsonSchemaPropertyInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "array",
        "description": "test-value",
        "items": {
            "type": "boolean",
            "description": "test-value",
            "enum": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
