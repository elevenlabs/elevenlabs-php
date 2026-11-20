<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationConfigClientOverrideConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "asr": {
            "keywords": true
        },
        "turn": {
            "soft_timeout_config": {
                "message": true,
                "additional_soft_timeout_messages": true
            },
            "noisy_environment_message": true
        },
        "tts": {
            "model_id": true,
            "voice_id": true,
            "supported_voices": true,
            "stability": true,
            "speed": true,
            "similarity_boost": true,
            "clone_strength": true,
            "pronunciation_dictionary_locators": true
        },
        "conversation": {
            "text_only": true,
            "max_duration_seconds": true
        },
        "agent": {
            "first_message": true,
            "language": true,
            "max_conversation_duration_message": true,
            "prompt": {
                "prompt": true,
                "llm": true,
                "reasoning_effort": true,
                "tool_ids": true,
                "tool_ids_strict": true,
                "native_mcp_server_ids": true,
                "knowledge_base": true
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationConfigClientOverrideConfigInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
