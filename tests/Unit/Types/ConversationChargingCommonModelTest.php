<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationChargingCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "dev_discount": true,
        "is_burst": true,
        "tier": "test-value",
        "llm_usage": {
            "irreversible_generation": {
                "model_usage": {
                    "key": {
                        "input": {
                            "tokens": 1,
                            "price": 1
                        },
                        "input_cache_read": {
                            "tokens": 1,
                            "price": 1
                        },
                        "input_cache_write": {
                            "tokens": 1,
                            "price": 1
                        },
                        "output_total": {
                            "tokens": 1,
                            "price": 1
                        }
                    }
                }
            },
            "initiated_generation": {
                "model_usage": {
                    "key": {
                        "input": {
                            "tokens": 1,
                            "price": 1
                        },
                        "input_cache_read": {
                            "tokens": 1,
                            "price": 1
                        },
                        "input_cache_write": {
                            "tokens": 1,
                            "price": 1
                        },
                        "output_total": {
                            "tokens": 1,
                            "price": 1
                        }
                    }
                }
            }
        },
        "llm_price": 1,
        "llm_charge": 1,
        "call_charge": 1,
        "platform_charge": 1,
        "platform_usage": {
            "category_usage": {
                "key": {
                    "credits": 1,
                    "price": 1,
                    "quantity": 1
                }
            }
        },
        "platform_price": 1,
        "free_minutes_consumed": 1,
        "free_llm_dollars_consumed": 1,
        "tts_usage": {
            "primary_tts_model": "test-value",
            "total_audio_output_seconds": 1,
            "total_characters": 1,
            "per_voice_usage": [
                {
                    "voice_id": "test-value",
                    "audio_output_seconds": 1
                }
            ]
        },
        "asr_usage": {
            "asr_model": "test-value",
            "total_transcription_calls": 1,
            "total_audio_input_seconds": 1
        },
        "analysis": {
            "total": {
                "price": 1,
                "charge": 1,
                "runs": 1,
                "price_per_feature": {
                    "key": 1
                },
                "charge_per_feature": {
                    "key": 1
                }
            },
            "last_run": {
                "price": 1,
                "charge": 1,
                "price_per_feature": {
                    "key": 1
                },
                "charge_per_feature": {
                    "key": 1
                }
            }
        },
        "voice_surcharge_charge": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationChargingCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
