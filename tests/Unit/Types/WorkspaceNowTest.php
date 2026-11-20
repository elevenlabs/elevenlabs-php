<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceNowTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "today": {
            "year": 2026,
            "month": 1,
            "day": 1
        },
        "hour": 0,
        "minute": 0,
        "fetched_at_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceNow::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
