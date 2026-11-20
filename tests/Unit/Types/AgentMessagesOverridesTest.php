<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentMessagesOverridesTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "prompt": "test-value",
        "llm": "gpt-4o-mini",
        "language": "test-value",
        "tool_ids": [
            "test-value"
        ],
        "native_mcp_server_ids": [
            "test-value"
        ],
        "knowledge_base_ids": [
            "test-value"
        ],
        "procedure_ids": [
            "test-value"
        ],
        "custom_llm_extra_body": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentMessagesOverrides::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
