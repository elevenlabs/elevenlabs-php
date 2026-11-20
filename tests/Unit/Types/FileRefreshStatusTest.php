<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FileRefreshStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "queued",
        "enqueued_at": 1,
        "started_at": 1,
        "completed_at": 1,
        "last_synced_at": 1,
        "error_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\FileRefreshStatus::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
