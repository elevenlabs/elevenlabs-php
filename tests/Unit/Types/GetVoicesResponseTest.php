<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetVoicesResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voices": [
            {
                "voice_id": "test-value",
                "name": "test-value",
                "samples": [
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
                ],
                "category": "generated",
                "fine_tuning": {
                    "is_allowed_to_fine_tune": true,
                    "state": {
                        "key": "not_started"
                    },
                    "verification_failures": [
                        "test-value"
                    ],
                    "verification_attempts_count": 1,
                    "manual_verification_requested": true,
                    "language": "test-value",
                    "progress": {
                        "key": 1
                    },
                    "message": {
                        "key": "test-value"
                    },
                    "dataset_duration_seconds": 1,
                    "verification_attempts": [
                        {
                            "text": "test-value",
                            "date_unix": 1,
                            "accepted": true,
                            "similarity": 1,
                            "levenshtein_distance": 1,
                            "recording": {
                                "recording_id": "test-value",
                                "mime_type": "test-value",
                                "size_bytes": 1,
                                "upload_date_unix": 1,
                                "transcription": "test-value"
                            }
                        }
                    ],
                    "slice_ids": [
                        "test-value"
                    ],
                    "manual_verification": {
                        "extra_text": "test-value",
                        "request_time_unix": 1,
                        "files": [
                            {
                                "file_id": "test-value",
                                "file_name": "test-value",
                                "mime_type": "test-value",
                                "size_bytes": 1,
                                "upload_date_unix": 1
                            }
                        ]
                    },
                    "max_verification_attempts": 1,
                    "next_max_verification_attempts_reset_unix_ms": 1,
                    "finetuning_state": "test-value"
                },
                "labels": {
                    "key": "test-value"
                },
                "description": "test-value",
                "preview_url": "test-value",
                "available_for_tiers": [
                    "test-value"
                ],
                "settings": {
                    "stability": 0,
                    "use_speaker_boost": true,
                    "similarity_boost": 0,
                    "style": 1,
                    "speed": 1,
                    "clone_strength": 0
                },
                "sharing": {
                    "status": "enabled",
                    "history_item_sample_id": "test-value",
                    "date_unix": 1,
                    "whitelisted_emails": [
                        "test-value"
                    ],
                    "public_owner_id": "test-value",
                    "original_voice_id": "test-value",
                    "financial_rewards_enabled": true,
                    "free_users_allowed": true,
                    "live_moderation_enabled": true,
                    "rate": 1,
                    "fiat_rate": 1,
                    "notice_period": 1,
                    "disable_at_unix": 1,
                    "voice_mixing_allowed": true,
                    "featured": true,
                    "category": "generated",
                    "reader_app_enabled": true,
                    "image_url": "test-value",
                    "ban_reason": "test-value",
                    "liked_by_count": 1,
                    "cloned_by_count": 1,
                    "name": "test-value",
                    "description": "test-value",
                    "labels": {
                        "key": "test-value"
                    },
                    "review_status": "not_requested",
                    "review_message": "test-value",
                    "enabled_in_library": true,
                    "instagram_username": "test-value",
                    "twitter_username": "test-value",
                    "youtube_username": "test-value",
                    "tiktok_username": "test-value",
                    "moderation_check": {
                        "date_checked_unix": 1,
                        "name_value": "test-value",
                        "name_check": true,
                        "description_value": "test-value",
                        "description_check": true,
                        "sample_ids": [
                            "test-value"
                        ],
                        "sample_checks": [
                            1
                        ],
                        "captcha_ids": [
                            "test-value"
                        ],
                        "captcha_checks": [
                            1
                        ]
                    },
                    "reader_restricted_on": [
                        {
                            "resource_type": "read",
                            "resource_id": "test-value"
                        }
                    ]
                },
                "high_quality_base_model_ids": [
                    "test-value"
                ],
                "verified_languages": [
                    {
                        "language": "test-value",
                        "model_id": "test-value",
                        "accent": "test-value",
                        "locale": "test-value",
                        "preview_url": "test-value"
                    }
                ],
                "collection_ids": [
                    "test-value"
                ],
                "safety_control": "NONE",
                "voice_verification": {
                    "requires_verification": true,
                    "is_verified": true,
                    "verification_failures": [
                        "test-value"
                    ],
                    "verification_attempts_count": 1,
                    "language": "test-value",
                    "verification_attempts": [
                        {
                            "text": "test-value",
                            "date_unix": 1,
                            "accepted": true,
                            "similarity": 1,
                            "levenshtein_distance": 1,
                            "recording": {
                                "recording_id": "test-value",
                                "mime_type": "test-value",
                                "size_bytes": 1,
                                "upload_date_unix": 1,
                                "transcription": "test-value"
                            }
                        }
                    ]
                },
                "permission_on_resource": "test-value",
                "is_owner": true,
                "is_legacy": true,
                "is_mixed": true,
                "favorited_at_unix": 1,
                "created_at_unix": 1,
                "is_bookmarked": true,
                "recording_quality": "studio",
                "labelling_status": "in_review",
                "recording_quality_reason": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetVoicesResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
