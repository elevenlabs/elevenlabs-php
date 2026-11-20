<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BuiltInToolsWorkflowOverrideInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "transfer_to_agent": {
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
        },
        "end_call": {
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
        },
        "language_detection": {
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
        },
        "transfer_to_number": {
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
        },
        "skip_turn": {
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
        },
        "play_keypad_touch_tone": {
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
        },
        "voicemail_detection": {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\BuiltInToolsWorkflowOverrideInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
