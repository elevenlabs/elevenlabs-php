<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SystemToolConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "system",
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
        "params": {
            "system_tool_type": "end_call"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SystemToolConfigOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
