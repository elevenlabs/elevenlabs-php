<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectVideoResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "video_id": "test-value",
        "filename": "test-value",
        "signed_url": "test-value",
        "signed_preview_url": "test-value",
        "offset_ms": 1,
        "duration_ms": 1,
        "volume_gain_db": 1,
        "muted": true,
        "fade_in_ms": 1,
        "fade_out_ms": 1,
        "width": 1,
        "height": 1,
        "codec": "test-value",
        "order": "test-value",
        "created_at_ms": 1,
        "updated_at_ms": 1,
        "error": "test-value",
        "thumbnail_interval_seconds": 1,
        "thumbnail_size": [
            1,
            1
        ],
        "thumbnail_sheets": [
            {
                "start_thumbnail_index": 1,
                "thumbnail_count": 1,
                "signed_cloud_url": "test-value"
            }
        ],
        "start_time_ms": 1,
        "end_time_ms": 1,
        "asset_preview_signed_url": "test-value",
        "source_video_id": "test-value",
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
        "audio_track_ready": true,
        "export_format_ready": true,
        "current_snapshot_id": "test-value",
        "source_context": {
            "source_type": "generation",
            "generation_id": "test-value",
            "prompt": "test-value",
            "model_id": "test-value",
            "model_provider": "test-value",
            "generation_session_id": "test-value",
            "session_iteration_id": "test-value",
            "model_parameters": {
                "key": "test-value"
            },
            "extend_video": {
                "generation_id": "test-value",
                "content_asset_id": "test-value",
                "template_node_id": "test-value",
                "studio_clip": {
                    "project_id": "test-value",
                    "chapter_id": "test-value",
                    "clip_type": "video",
                    "clip_id": "test-value",
                    "block_id": "test-value",
                    "preview_url": "test-value"
                }
            }
        },
        "analysis": {
            "status": "processing",
            "data": {
                "title": "test-value",
                "description": "test-value",
                "content_type": "test-value",
                "overall_pacing": "test-value",
                "subjects": [
                    {
                        "name": "test-value",
                        "description": "test-value"
                    }
                ],
                "segments": [
                    {
                        "start_ms": 1,
                        "end_ms": 1,
                        "description": "test-value",
                        "subjects": [
                            "test-value"
                        ],
                        "shot_type": "test-value",
                        "camera_movement": "test-value",
                        "transition_in": "test-value",
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
        "type": "video",
        "canvas_placement": {
            "x_relative": 1,
            "y_relative": 1,
            "scale_x": 1,
            "scale_y": 1,
            "pivot_x": 1,
            "pivot_y": 1,
            "skew_x": 1,
            "skew_y": 1,
            "crop_top": 1,
            "crop_right": 1,
            "crop_bottom": 1,
            "crop_left": 1,
            "flip_x": true,
            "flip_y": true
        },
        "animation": {
            "enter_effect": "none",
            "enter_duration_ms": 1,
            "exit_effect": "none",
            "exit_duration_ms": 1
        },
        "playback_speed": 1,
        "opacity": 0,
        "track_id": "test-value",
        "preview_job_progress": 1,
        "import_speech_progress": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectVideoResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
