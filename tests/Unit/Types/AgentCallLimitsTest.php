<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentCallLimitsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_concurrency_limit": 1,
        "daily_limit": 1,
        "bursting_enabled": true
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentCallLimits::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
