<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionCustomerFacingAgentResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "config": {
            "additional_instructions": "test-value",
            "tone_traits": [
                "test-value"
            ],
            "details_to_collect": [
                "test-value"
            ],
            "llm": "gpt-4o-mini",
            "reasoning_effort": "none",
            "disable_rag": true,
            "background_voice_detection": true,
            "turn_eagerness": "patient",
            "voice_id": "test-value",
            "language": "test-value",
            "additional_languages": [
                "test-value"
            ],
            "first_message": "test-value",
            "first_message_mode": "interruptible",
            "enable_end_call_tool": true,
            "enable_skip_turn_tool": true,
            "enable_play_keypad_touch_tone_tool": true,
            "agent_rules": [
                {
                    "title": "test-value",
                    "description": "test-value",
                    "priority": "strict",
                    "id": "test-value",
                    "created_at_unix": 1
                }
            ],
            "transfer_rules": [
                {
                    "label": "test-value",
                    "phone_number": "test-value",
                    "condition": "test-value",
                    "post_dial_digits": "test-value",
                    "id": "test-value",
                    "created_at_unix": 1
                }
            ],
            "hide_caller_number_on_transfers": true,
            "record_after_transfers": true,
            "procedures": [
                {
                    "name": "test-value",
                    "trigger": "test-value",
                    "body": "test-value",
                    "id": "test-value",
                    "created_at_unix": 1,
                    "source_key": "test-value"
                }
            ],
            "enable_secure_mode": true,
            "enable_spam_protection": true
        },
        "deactivated_at_unix": 1,
        "deactivation_reason": "tier_downgrade",
        "name": "test-value",
        "agent_exists": true,
        "is_transfer_allowed": true,
        "widget": {
            "orb_color_1": "test-value",
            "orb_color_2": "test-value",
            "variant": "tiny",
            "placement": "top-left",
            "dismissible": true,
            "main_label": "test-value",
            "start_call": "test-value"
        },
        "is_active": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionCustomerFacingAgentResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
