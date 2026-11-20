<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryMetadataCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time_unix_secs": 1,
        "accepted_time_unix_secs": 1,
        "call_duration_secs": 1,
        "queue_wait_secs": 1,
        "cost": 1,
        "deletion_settings": {
            "deletion_time_unix_secs": 1,
            "deleted_logs_at_time_unix_secs": 1,
            "deleted_audio_at_time_unix_secs": 1,
            "deleted_transcript_at_time_unix_secs": 1,
            "delete_transcript_and_pii": true,
            "delete_audio": true
        },
        "feedback": {
            "type": "thumbs",
            "overall_score": "like",
            "likes": 1,
            "dislikes": 1,
            "rating": 1,
            "comment": "test-value"
        },
        "authorization_method": "invalid",
        "charging": {
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
        },
        "phone_call": {
            "direction": "inbound",
            "phone_number_id": "test-value",
            "agent_number": "test-value",
            "external_number": "test-value",
            "call_result": "answered",
            "type": "twilio",
            "stream_sid": "test-value",
            "call_sid": "test-value"
        },
        "batch_call": {
            "batch_call_id": "test-value",
            "batch_call_recipient_id": "test-value",
            "campaign": {
                "campaign_id": "test-value",
                "campaign_lead_id": "test-value",
                "cold_attempt": 1,
                "conversation_type": "initial"
            }
        },
        "termination_reason": "test-value",
        "error": {
            "code": 1,
            "reason": "test-value"
        },
        "warnings": [
            "test-value"
        ],
        "main_language": "test-value",
        "rag_usage": {
            "usage_count": 1,
            "embedding_model": "test-value"
        },
        "text_only": true,
        "features_usage": {
            "language_detection": {
                "enabled": true,
                "used": true
            },
            "transfer_to_agent": {
                "enabled": true,
                "used": true
            },
            "transfer_to_number": {
                "enabled": true,
                "used": true
            },
            "multivoice": {
                "enabled": true,
                "used": true
            },
            "dtmf_tones": {
                "enabled": true,
                "used": true
            },
            "external_mcp_servers": {
                "enabled": true,
                "used": true
            },
            "pii_zrm_workspace": true,
            "pii_zrm_agent": true,
            "tool_dynamic_variable_updates": {
                "enabled": true,
                "used": true
            },
            "is_livekit": true,
            "voicemail_detection": {
                "enabled": true,
                "used": true
            },
            "dtmf_input": {
                "enabled": true,
                "used": true
            },
            "workflow": {
                "enabled": true,
                "tool_node": {
                    "enabled": true,
                    "used": true
                },
                "standalone_agent_node": {
                    "enabled": true,
                    "used": true
                },
                "phone_number_node": {
                    "enabled": true,
                    "used": true
                },
                "end_node": {
                    "enabled": true,
                    "used": true
                },
                "override_agent_node": {
                    "enabled": true,
                    "used": true
                }
            },
            "agent_testing": {
                "enabled": true,
                "tests_ran_after_last_modification": true,
                "tests_ran_in_last_7_days": true
            },
            "versioning": {
                "enabled": true,
                "used": true
            },
            "file_input": {
                "enabled": true,
                "used": true
            },
            "freeform_procedure": {
                "enabled": true,
                "used": true
            },
            "structured_procedure": {
                "enabled": true,
                "used": true
            }
        },
        "eleven_assistant": {
            "is_eleven_assistant": true
        },
        "initiator_id": "test-value",
        "conversation_initiation_source": "unknown",
        "conversation_initiation_source_version": "test-value",
        "timezone": "test-value",
        "async_metadata": {
            "delivery_status": "pending",
            "delivery_timestamp": 1,
            "delivery_error": "test-value",
            "external_system": "test-value",
            "external_id": "test-value",
            "external_link": "test-value",
            "retry_count": 1,
            "last_retry_timestamp": 1,
            "last_processed_external_message_id": "test-value",
            "integration_trigger_id": "test-value",
            "platform_metadata": {
                "conversation_initiation_source": "plain_integration",
                "thread_id": "test-value",
                "workspace_id": "test-value"
            }
        },
        "whatsapp": {
            "direction": "inbound",
            "whatsapp_phone_number_id": "test-value",
            "whatsapp_user_id": "test-value",
            "awaiting_first_user_message": true,
            "recipient": {
                "phone": "test-value",
                "bsuid": "test-value"
            },
            "call_permission_request": {
                "state": "blocked",
                "requested_at_unix": 1,
                "responded_at_unix": 1,
                "permanent": true,
                "granted_by_user_call": true
            },
            "call_result": "answered",
            "opening_message": {
                "template_name": "test-value",
                "wamid": "test-value",
                "sent_at_unix": 1,
                "delivered_at_unix": 1,
                "read_at_unix": 1,
                "replied_at_unix": 1,
                "failed_at_unix": 1,
                "error_code": "test-value",
                "pricing_category": "test-value",
                "billable": true
            }
        },
        "sms": {
            "direction": "inbound",
            "phone_number_id": "test-value",
            "sms_user_phone_number": "test-value",
            "agent_phone_number": "test-value"
        },
        "agent_created_from": "cli",
        "agent_last_updated_from": "cli",
        "voice_rewards": [
            {
                "voice_id": "test-value",
                "reward_usd_cents": 1
            }
        ],
        "cost_fiat": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryMetadataCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
