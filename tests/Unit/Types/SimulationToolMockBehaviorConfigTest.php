<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SimulationToolMockBehaviorConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mocking_strategy": "all",
        "fallback_strategy": "call_real_tool",
        "mocked_tool_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SimulationToolMockBehaviorConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
