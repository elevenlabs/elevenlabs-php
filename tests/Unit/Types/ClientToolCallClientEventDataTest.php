<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientToolCallClientEventDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_name": "test-value",
        "tool_call_id": "test-value",
        "parameters": {
            "key": "test-value"
        },
        "event_id": 1,
        "expects_response": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientToolCallClientEventData::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
