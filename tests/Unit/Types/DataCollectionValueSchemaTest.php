<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DataCollectionValueSchemaTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\DataCollectionValueSchema::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
