<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationUserTranscriptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_transcription_event": {
            "user_transcript": "test-value",
            "event_id": 1
        },
        "type": "user_transcript"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationUserTranscript::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
