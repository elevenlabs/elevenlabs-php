<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Requests;

use PHPUnit\Framework\TestCase;

class CreateAgentConversationRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent": {
            "type": "persisted",
            "agent_id": "test-value",
            "branch_id": "test-value",
            "overrides": {
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
        },
        "environment": "test-value",
        "user_id": "test-value",
        "dynamic_variables": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Agents\Conversations\Requests\CreateAgentConversationRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
