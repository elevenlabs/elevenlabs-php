<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TurnConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "turn_timeout": 1,
        "initial_wait_time": 1,
        "silence_end_call_timeout": 1,
        "turn_eagerness": "patient",
        "spelling_patience": "auto",
        "speculative_turn": true,
        "retranscribe_on_turn_timeout": true,
        "turn_model": "turn_v2",
        "interruption_ignore_terms": [
            "test-value"
        ],
        "interruption_ignore_term_languages": [
            "test-value"
        ],
        "merge_with_default_ignore_terms": true,
        "transcribe_on_disabled_interruptions": true,
        "soft_timeout_config": {
            "timeout_seconds": 1,
            "message": "test-value",
            "additional_soft_timeout_messages": [
                "test-value"
            ],
            "use_llm_generated_message": true,
            "randomize_fillers": true,
            "max_soft_timeouts_per_generation": 1,
            "pause_after_filler": true,
            "llm_generated_message_prompt_override": "test-value",
            "disable_until_first_user_message": true
        },
        "noisy_environment_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TurnConfigWorkflowOverride::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
