<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationPingTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "ping_event": {
            "event_id": 1,
            "ping_ms": 1
        },
        "type": "ping"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationPing::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
