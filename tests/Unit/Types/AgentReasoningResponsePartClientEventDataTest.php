<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentReasoningResponsePartClientEventDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "type": "start",
        "event_id": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentReasoningResponsePartClientEventData::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
