<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowStartNodeModelOutputTest extends TestCase
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

    $instance = \ElevenLabs\Types\WorkflowStartNodeModelOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
