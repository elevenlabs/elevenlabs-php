<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentAnalysisItemsInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "evaluation_criteria": [
            {
                "source": "user",
                "analysis_item_id": "test-value",
                "version_id": "test-value",
                "additional_version_ids": [
                    "test-value"
                ],
                "scope": "conversation",
                "weight": 1
            }
        ],
        "data_collection": [
            {
                "source": "user",
                "analysis_item_id": "test-value",
                "version_id": "test-value",
                "scope": "conversation"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentAnalysisItemsInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
