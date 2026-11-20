<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowStartNodeModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "start",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowStartNodeModelInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
