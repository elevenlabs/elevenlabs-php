<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ObjectSchemaTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value",
        "type": "object",
        "properties": {
            "key": {
                "title": "test-value",
                "description": "test-value",
                "type": "string",
                "enum": [
                    "test-value"
                ]
            }
        },
        "required": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ObjectSchema::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
