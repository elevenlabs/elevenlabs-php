<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SafetyCommonModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "ivc": {
            "is_unsafe": true,
            "llm_reason": "test-value",
            "safety_prompt_version": 1,
            "matched_rule_id": [
                "sexual_minors"
            ]
        },
        "non_ivc": {
            "is_unsafe": true,
            "llm_reason": "test-value",
            "safety_prompt_version": 1,
            "matched_rule_id": [
                "sexual_minors"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SafetyCommonModelInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
