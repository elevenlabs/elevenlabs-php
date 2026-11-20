<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowUpdateStateNodeModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "update_state",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "label": "test-value",
        "updates": [
            {
                "type": "dynamic_variable",
                "variable_name": "test-value",
                "expression": {
                    "type": "string_literal",
                    "value": "test-value"
                },
                "required": true
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
