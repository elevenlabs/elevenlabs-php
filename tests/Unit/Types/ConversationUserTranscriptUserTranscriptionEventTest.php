<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationUserTranscriptUserTranscriptionEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_transcript": "test-value",
        "event_id": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationUserTranscriptUserTranscriptionEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
