<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\SpeechEngine\Requests;

use PHPUnit\Framework\TestCase;

class UpdateSpeechEngineRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "speech_engine": {
            "ws_url": "test-value",
            "request_headers": {
                "key": "test-value"
            }
        },
        "asr": {
            "quality": "high",
            "provider": "elevenlabs",
            "user_input_audio_format": "pcm_8000",
            "keywords": [
                "test-value"
            ]
        },
        "tts": {
            "model_id": "eleven_turbo_v2",
            "voice_id": "test-value",
            "supported_voices": [
                {
                    "label": "test-value",
                    "voice_id": "test-value",
                    "description": "test-value",
                    "language": "test-value",
                    "model_family": "turbo",
                    "optimize_streaming_latency": 0,
                    "stability": 0,
                    "speed": 0.7,
                    "similarity_boost": 0,
                    "clone_strength": 0
                }
            ],
            "expressive_mode": true,
            "suggested_audio_tags": [
                {
                    "tag": "test-value",
                    "description": "test-value"
                }
            ],
            "agent_output_audio_format": "pcm_8000",
            "optimize_streaming_latency": 0,
            "stability": 0,
            "speed": 0.7,
            "similarity_boost": 0,
            "clone_strength": 0,
            "text_normalisation_type": "system_prompt",
            "pronunciation_dictionary_locators": [
                {
                    "pronunciation_dictionary_id": "test-value",
                    "version_id": "test-value"
                }
            ],
            "enable_phoneme_tags": true,
            "audio_effects": {
                "filter_preset_id": "test-value",
                "distance": 0,
                "environment_id": "test-value",
                "background_noise_id": "test-value",
                "send_level": 0,
                "pan": -1
            }
        },
        "turn": {
            "turn_timeout": 1,
            "initial_wait_time": 1,
            "silence_end_call_timeout": 1,
            "turn_eagerness": "patient",
            "spelling_patience": "auto",
            "speculative_turn": true,
            "retranscribe_on_turn_timeout": true,
            "turn_model": "turn_v2",
            "interruption_ignore_terms": [
                "test-value"
            ],
            "interruption_ignore_term_languages": [
                "test-value"
            ],
            "merge_with_default_ignore_terms": true,
            "transcribe_on_disabled_interruptions": true
        },
        "conversation": {
            "text_only": true,
            "max_duration_seconds": 1,
            "client_events": [
                "conversation_initiation_metadata"
            ],
            "file_input": {
                "enabled": true,
                "max_files_in_memory": 1,
                "max_files_per_conversation": 1
            },
            "monitoring_enabled": true,
            "monitoring_events": [
                "conversation_initiation_metadata"
            ],
            "dtmf_input_settings": {
                "dtmf_input_timeout": 0.5,
                "hash_terminator": true,
                "redact_input": true
            },
            "background_sound": {
                "source_type": "preset",
                "source_id": "office2",
                "volume": 0.01,
                "crossfade_loop": true
            },
            "source_attribution": true
        },
        "privacy": {
            "record_voice": true,
            "retention_days": 1,
            "delete_transcript_and_pii": true,
            "delete_audio": true,
            "apply_to_existing_conversations": true,
            "zero_retention_mode": true,
            "conversation_history_redaction": {
                "enabled": true,
                "entities": [
                    "name"
                ],
                "excluded_data_collection_ids": [
                    "test-value"
                ]
            }
        },
        "call_limits": {
            "agent_concurrency_limit": 1,
            "daily_limit": 1,
            "bursting_enabled": true
        },
        "auth": {
            "enable_auth": true
        },
        "language": "test-value",
        "cascade_timeout_seconds": 2,
        "tags": [
            "test-value"
        ],
        "overrides": {
            "first_message": true
        }
    }
    JSON;

    $instance = \ElevenLabs\SpeechEngine\Requests\UpdateSpeechEngineRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
