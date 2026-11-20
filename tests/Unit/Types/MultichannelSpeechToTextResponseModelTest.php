<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MultichannelSpeechToTextResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "transcripts": [
            {
                "language_code": "test-value",
                "language_probability": 1,
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
                ],
                "channel_index": 1,
                "additional_formats": [
                    {
                        "requested_format": "test-value",
                        "file_extension": "test-value",
                        "content_type": "test-value",
                        "is_base64_encoded": true,
                        "content": "test-value"
                    }
                ],
                "transcription_id": "test-value",
                "entities": [
                    {
                        "text": "test-value",
                        "entity_type": "test-value",
                        "start_char": 1,
                        "end_char": 1
                    }
                ],
                "audio_duration_secs": 1,
                "edited_transcript": {
                    "kind": "transcript",
                    "text": "test-value",
                    "edited_text": "test-value"
                }
            }
        ],
        "transcription_id": "test-value",
        "audio_duration_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\MultichannelSpeechToTextResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
