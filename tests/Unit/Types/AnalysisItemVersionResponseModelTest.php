<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AnalysisItemVersionResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "version_number": 1,
        "created_at_unix_secs": 1,
        "definition": {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\AnalysisItemVersionResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
