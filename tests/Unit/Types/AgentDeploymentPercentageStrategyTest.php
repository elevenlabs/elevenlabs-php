<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentDeploymentPercentageStrategyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "percentage",
        "traffic_percentage": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentDeploymentPercentageStrategy::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
