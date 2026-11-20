<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PartialTranscriptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "partial_transcript",
        "text": "test-value",
        "turn_probability": 1,
        "language_code": "test-value",
        "words": [
            {
                "text": "test-value",
                "start": 1,
                "end": 1,
                "type": "word",
                "speaker_id": "test-value",
                "logprob": 1,
                "characters": [
                    {
                        "text": "test-value",
                        "start": 1,
                        "end": 1
                    }
                ],
                "channel_index": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\PartialTranscript::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
