<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UserEvaluationAnalysisItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "source": "user",
        "llm": "gpt-4o-mini",
        "kind": "evaluation",
        "conversation_goal_prompt": "test-value",
        "use_knowledge_base": true,
        "scoring": {
            "mode": "binary"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\UserEvaluationAnalysisItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
