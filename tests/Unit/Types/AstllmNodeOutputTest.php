<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AstllmNodeOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "llm",
        "value_schema": {
            "type": "boolean",
            "description": "test-value",
            "enum": [
                "test-value"
            ]
        },
        "prompt": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AstllmNodeOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
