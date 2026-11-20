<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StreamingAudioChunkWithTimestampsAndVoiceSegmentsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio_base64": "test-value",
        "alignment": {
            "characters": [
                "test-value"
            ],
            "character_start_times_seconds": [
                1
            ],
            "character_end_times_seconds": [
                1
            ]
        },
        "normalized_alignment": {
            "characters": [
                "test-value"
            ],
            "character_start_times_seconds": [
                1
            ],
            "character_end_times_seconds": [
                1
            ]
        },
        "voice_segments": [
            {
                "voice_id": "test-value",
                "start_time_seconds": 1,
                "end_time_seconds": 1,
                "character_start_index": 1,
                "character_end_index": 1,
                "dialogue_input_index": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\StreamingAudioChunkWithTimestampsAndVoiceSegmentsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
