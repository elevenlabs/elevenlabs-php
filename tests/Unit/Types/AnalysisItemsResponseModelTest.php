<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AnalysisItemsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "analysis_items": [
            {
                "id": "test-value",
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
                },
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "created_at_unix_secs": 1,
                "updated_at_unix_secs": 1,
                "current_version_id": "test-value",
                "legacy_source_id": "test-value"
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\AnalysisItemsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
