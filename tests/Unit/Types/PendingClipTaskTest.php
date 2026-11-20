<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PendingClipTaskTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "preprocessing",
        "progress": 1,
        "started_at_ms": 1,
        "updated_at_ms": 1,
        "metadata": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PendingClipTask::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
