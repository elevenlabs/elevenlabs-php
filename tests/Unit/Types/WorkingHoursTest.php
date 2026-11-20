<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkingHoursTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "hours": {
            "key": [
                {
                    "start_hour": 0,
                    "start_minute": 0,
                    "end_hour": 0,
                    "end_minute": 0
                }
            ]
        },
        "timezone": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkingHours::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
