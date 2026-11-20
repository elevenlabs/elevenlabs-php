<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EvaluationSettingsOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "criteria": [
            {
                "id": "test-value",
                "name": "test-value",
                "type": "prompt",
                "conversation_goal_prompt": "test-value",
                "use_knowledge_base": true,
                "scope": "conversation",
                "llm": "gpt-4o-mini",
                "scoring_mode": "binary",
                "max_score": 1,
                "score_instructions": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\EvaluationSettingsOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
