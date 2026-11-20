<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SafetyEvaluationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_unsafe": true,
        "llm_reason": "test-value",
        "safety_prompt_version": 1,
        "matched_rule_id": [
            "sexual_minors"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SafetyEvaluation::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
