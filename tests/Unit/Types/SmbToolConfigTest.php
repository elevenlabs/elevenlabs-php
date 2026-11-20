<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SmbToolConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "smb",
        "name": "test-value",
        "description": "test-value",
        "response_timeout_secs": 1,
        "disable_interruptions": true,
        "interruption_mode": "allow",
        "force_pre_tool_speech": true,
        "pre_tool_speech": "auto",
        "assignments": [
            {
                "source": "response",
                "dynamic_variable": "test-value",
                "value_path": "test-value",
                "sanitize": true,
                "preserve_native_type": true
            }
        ],
        "tool_call_sound": "typing",
        "tool_call_sound_behavior": "auto",
        "tool_error_handling_mode": "auto",
        "human_description": "test-value",
        "enabled": true,
        "params": {
            "smb_tool_type": "search_clients"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SmbToolConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
