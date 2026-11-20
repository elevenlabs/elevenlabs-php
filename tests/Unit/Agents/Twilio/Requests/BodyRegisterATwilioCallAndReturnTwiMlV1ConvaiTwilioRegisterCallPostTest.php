<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Twilio\Requests;

use PHPUnit\Framework\TestCase;

class BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "from_number": "test-value",
        "to_number": "test-value",
        "direction": "inbound",
        "conversation_initiation_client_data": {
            "conversation_config_override": {
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
            "custom_llm_extra_body": {
                "key": "test-value"
            },
            "user_id": "test-value",
            "source_info": {
                "source": "unknown",
                "version": "test-value"
            },
            "branch_id": "test-value",
            "environment": "test-value",
            "starting_workflow_node_id": "test-value",
            "procedure_ids": [
                "test-value"
            ],
            "start_procedure_ids": [
                "test-value"
            ],
            "dynamic_variables": {
                "key": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Agents\Twilio\Requests\BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
