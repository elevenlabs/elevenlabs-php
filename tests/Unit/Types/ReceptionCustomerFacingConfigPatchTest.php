<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionCustomerFacingConfigPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
        "hide_caller_number_on_transfers": true,
        "record_after_transfers": true,
        "enable_secure_mode": true,
        "enable_spam_protection": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionCustomerFacingConfigPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
