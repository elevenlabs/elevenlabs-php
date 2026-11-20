<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UnitTestWorkflowNodeTransitionEvaluationNodeIdTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "node_id",
        "agent_id": "test-value",
        "target_node_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UnitTestWorkflowNodeTransitionEvaluationNodeId::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
