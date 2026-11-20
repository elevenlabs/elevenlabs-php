<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\McpServers\Requests;

use PHPUnit\Framework\TestCase;

class McpServerConfigUpdateRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "approval_policy": "auto_approve_all",
        "force_pre_tool_speech": true,
        "pre_tool_speech": "auto",
        "disable_interruptions": true,
        "interruption_mode": "allow",
        "tool_call_sound": "typing",
        "tool_call_sound_behavior": "auto",
        "execution_mode": "immediate",
        "response_timeout_secs": 5,
        "request_headers": {
            "key": "test-value"
        },
        "request_meta": {
            "key": "test-value"
        },
        "disable_compression": true,
        "secret_token": {
            "secret_id": "test-value"
        },
        "auth_connection": {
            "auth_connection_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Agents\McpServers\Requests\McpServerConfigUpdateRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
