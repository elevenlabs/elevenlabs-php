<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationClientDataConversationConfigOverrideAgentPromptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationClientDataConversationConfigOverrideAgentPrompt::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
