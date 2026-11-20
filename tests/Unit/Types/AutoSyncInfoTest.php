<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AutoSyncInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "minimum_frequency_days": 1,
        "auto_remove": true,
        "consec_failures": 0,
        "next_refresh_by": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AutoSyncInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
