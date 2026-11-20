<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LanguagePresetInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "overrides": {
            "asr": {
                "keywords": [
                    "test-value"
                ]
            },
            "turn": {
                "soft_timeout_config": {
                    "message": "test-value",
                    "additional_soft_timeout_messages": [
                        "test-value"
                    ]
                },
                "noisy_environment_message": "test-value"
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
                "stability": 1,
                "speed": 1,
                "similarity_boost": 1,
                "clone_strength": 1,
                "pronunciation_dictionary_locators": [
                    {
                        "pronunciation_dictionary_id": "test-value",
                        "version_id": "test-value"
                    }
                ]
            },
            "conversation": {
                "text_only": true,
                "max_duration_seconds": 1
            },
            "agent": {
                "first_message": "test-value",
                "language": "test-value",
                "max_conversation_duration_message": "test-value",
                "prompt": {
                    "prompt": "test-value",
                    "llm": "gpt-4o-mini",
                    "reasoning_effort": "none",
                    "tool_ids": [
                        "test-value"
                    ],
                    "tool_ids_strict": true,
                    "native_mcp_server_ids": [
                        "test-value"
                    ],
                    "knowledge_base": [
                        {
                            "type": "file",
                            "name": "test-value",
                            "id": "test-value",
                            "usage_mode": "prompt"
                        }
                    ]
                }
            }
        },
        "first_message_translation": {
            "source_hash": "test-value",
            "text": "test-value"
        },
        "soft_timeout_translation": {
            "source_hash": "test-value",
            "text": "test-value"
        },
        "noisy_environment_message_translation": {
            "source_hash": "test-value",
            "text": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LanguagePresetInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
