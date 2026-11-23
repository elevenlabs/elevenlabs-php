<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class QueueStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "queue_status_event": {
            "status": "waiting"
        },
        "type": "queue_status"
    }
    JSON;

    $instance = \ElevenLabs\Types\QueueStatus::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
