<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SoftTimeoutConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\SoftTimeoutConfigWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
