<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PodcastConversationModeDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "host_voice_id": "test-value",
        "guest_voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PodcastConversationModeData::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
