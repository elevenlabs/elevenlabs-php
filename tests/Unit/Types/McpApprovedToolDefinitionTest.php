<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpApprovedToolDefinitionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "description": "test-value",
        "input_schema": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\McpApprovedToolDefinition::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
