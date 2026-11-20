<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowToolNodeModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "tool",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "tools": [
            {
                "tool_id": "test-value",
                "schema_overrides": {
                    "key": {
                        "source": "constant",
                        "constant_value": "test-value"
                    }
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowToolNodeModelInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
