<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectExternalAudioResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "external_audio_id": "test-value",
        "filename": "test-value",
        "signed_url": "test-value",
        "offset_ms": 1,
        "duration_ms": 1,
        "start_time_ms": 1,
        "end_time_ms": 1,
        "order": "test-value",
        "track_id": "test-value",
        "created_at_ms": 1,
        "updated_at_ms": 1,
        "volume_gain_db": 1,
        "muted": true,
        "fade_in_ms": 1,
        "fade_out_ms": 1,
        "source_external_audio_id": "test-value",
        "source_asset_id": "test-value",
        "source_platform_asset_id": "test-value",
        "pending_blocks_metadata": {
            "target_global_offset_ms": 1,
            "block_ids": [
                "test-value"
            ]
        },
        "pending_external_audios_metadata": {
            "target_global_offset_ms": 1,
            "external_audio_ids": [
                "test-value"
            ]
        },
        "speech_imported": true,
        "pending_task": {
            "type": "preprocessing",
            "progress": 1,
            "started_at_ms": 1,
            "updated_at_ms": 1,
            "metadata": {
                "key": "test-value"
            }
        },
        "error": "test-value",
        "current_snapshot_id": "test-value",
        "source_context": {
            "source_type": "song",
            "song_id": "test-value",
            "chat_id": "test-value",
            "title": "test-value",
            "description": "test-value",
            "genres": [
                "test-value"
            ],
            "languages": [
                "test-value"
            ],
            "is_explicit": true,
            "bpm": 1,
            "generation_settings": {
                "key": "test-value"
            }
        },
        "analysis": {
            "status": "processing",
            "data": {
                "title": "test-value",
                "description": "test-value",
                "content_type": "test-value",
                "overall_pacing": "test-value",
                "segments": [
                    {
                        "start_ms": 1,
                        "end_ms": 1,
                        "description": "test-value",
                        "segment_type": "test-value",
                        "has_speech": true,
                        "has_music": true,
                        "pacing": "test-value"
                    }
                ],
                "key_moments": [
                    {
                        "timestamp_ms": 1,
                        "type": "test-value",
                        "description": "test-value"
                    }
                ]
            },
            "updated_at_ms": 1
        },
        "transcription": {
            "status": "processing",
            "data": {
                "language_code": "test-value",
                "text": "test-value",
                "words": [
                    "test-value"
                ],
                "word_start_times_ms": [
                    1
                ],
                "word_end_times_ms": [
                    1
                ],
                "word_speaker_ids": [
                    "test-value"
                ]
            },
            "updated_at_ms": 1
        },
        "type": "audio",
        "import_speech_progress": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectExternalAudioResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
