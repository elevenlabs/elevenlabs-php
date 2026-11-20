<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowToolEdgeStepModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "step_latency_secs": 1,
        "type": "edge",
        "edge_id": "test-value",
        "target_node_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowToolEdgeStepModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
