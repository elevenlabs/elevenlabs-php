<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UnitTestToolCallEvaluationModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "parameters": [
            {
                "eval": {
                    "type": "llm",
                    "description": "test-value"
                },
                "path": "test-value"
            }
        ],
        "referenced_tool": {
            "id": "test-value",
            "type": "system"
        },
        "verify_absence": true,
        "workflow_node_transition": {
            "type": "node_id",
            "agent_id": "test-value",
            "target_node_id": "test-value"
        },
        "guardrail_trigger": {
            "type": "any"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\UnitTestToolCallEvaluationModelOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
