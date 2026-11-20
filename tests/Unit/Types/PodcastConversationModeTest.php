<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PodcastConversationModeTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "conversation",
        "conversation": {
            "host_voice_id": "test-value",
            "guest_voice_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PodcastConversationMode::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
