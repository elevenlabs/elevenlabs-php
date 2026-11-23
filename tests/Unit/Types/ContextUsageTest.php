<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ContextUsageTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "context_usage_event": {
            "event_id": 1,
            "model": "test-value",
            "context_tokens": 1,
            "context_limit_tokens": 1
        },
        "type": "context_usage"
    }
    JSON;

    $instance = \ElevenLabs\Types\ContextUsage::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
