<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SelfSubagentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "execution_mode": "immediate",
        "timeout_secs": 10,
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SelfSubagent::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
