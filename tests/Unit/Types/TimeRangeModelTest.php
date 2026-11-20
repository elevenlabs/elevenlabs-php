<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TimeRangeModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_hour": 0,
        "start_minute": 0,
        "end_hour": 0,
        "end_minute": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\TimeRangeModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
