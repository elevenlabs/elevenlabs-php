<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowEndNodeModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "end",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "outcome": "success"
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowEndNodeModelInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
