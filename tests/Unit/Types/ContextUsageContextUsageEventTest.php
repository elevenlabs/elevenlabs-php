<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ContextUsageContextUsageEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "event_id": 1,
        "model": "test-value",
        "context_tokens": 1,
        "context_limit_tokens": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ContextUsageContextUsageEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
