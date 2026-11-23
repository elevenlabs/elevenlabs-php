<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseMetadataAgentResponseMetadataEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "metadata": {
            "key": "test-value"
        },
        "event_id": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseMetadataAgentResponseMetadataEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
