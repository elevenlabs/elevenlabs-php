<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmLiteralJsonSchemaPropertyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "boolean",
        "description": "test-value",
        "enum": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmLiteralJsonSchemaProperty::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
