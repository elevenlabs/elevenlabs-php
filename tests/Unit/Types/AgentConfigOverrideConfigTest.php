<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentConfigOverrideConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\AgentConfigOverrideConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
