<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowEdgeModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "test-value",
        "target": "test-value",
        "forward_condition": {
            "label": "test-value",
            "type": "unconditional"
        },
        "backward_condition": {
            "label": "test-value",
            "type": "unconditional"
        },
        "reroutes": [
            {
                "x": 1,
                "y": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowEdgeModelInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
