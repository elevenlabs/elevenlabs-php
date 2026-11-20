<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSampleTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sample_id": "test-value",
        "file_name": "test-value",
        "mime_type": "test-value",
        "size_bytes": 1,
        "hash": "test-value",
        "duration_secs": 1,
        "remove_background_noise": true,
        "has_isolated_audio": true,
        "has_isolated_audio_preview": true,
        "speaker_separation": {
            "voice_id": "test-value",
            "sample_id": "test-value",
            "status": "not_started",
            "speakers": {
                "key": {
                    "speaker_id": "test-value",
                    "duration_secs": 1,
                    "utterances": [
                        {
                            "start": 1,
                            "end": 1
                        }
                    ]
                }
            },
            "selected_speaker_ids": [
                "test-value"
            ]
        },
        "trim_start": 1,
        "trim_end": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSample::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
