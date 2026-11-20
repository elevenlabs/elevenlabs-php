<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ArraySchemaTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value",
        "type": "array",
        "items": {
            "title": "test-value",
            "description": "test-value",
            "type": "string",
            "enum": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ArraySchema::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
