<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentDeploymentRequestItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "branch_id": "test-value",
        "deployment_strategy": {
            "type": "percentage",
            "traffic_percentage": 0
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentDeploymentRequestItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
