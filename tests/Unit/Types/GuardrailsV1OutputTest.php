<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GuardrailsV1OutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "version": "1",
        "focus": {
            "is_enabled": true
        },
        "prompt_injection": {
            "is_enabled": true
        },
        "content": {
            "execution_mode": "streaming",
            "config": {
                "sexual": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "violence": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "harassment": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "self_harm": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "profanity": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "religion_or_politics": {
                    "is_enabled": true,
                    "threshold": 1
                },
                "medical_and_legal_information": {
                    "is_enabled": true,
                    "threshold": 1
                }
            },
            "trigger_action": {
                "type": "end_call"
            }
        },
        "custom": {
            "config": {
                "configs": [
                    {
                        "is_enabled": true,
                        "name": "test-value",
                        "prompt": "test-value",
                        "execution_mode": "streaming",
                        "model": "gemini-2.5-flash-lite",
                        "service_tier": "standard",
                        "history_message_count": 0,
                        "trigger_action": {
                            "type": "end_call"
                        },
                        "evaluate_full_response_only": true
                    }
                ]
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GuardrailsV1Output::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
