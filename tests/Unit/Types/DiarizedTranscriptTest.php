<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DiarizedTranscriptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "diarized_transcript",
        "segment_index": 1,
        "text": "test-value",
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

    $instance = \ElevenLabs\Types\DiarizedTranscript::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
