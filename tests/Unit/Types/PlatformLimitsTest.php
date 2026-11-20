<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlatformLimitsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "credits": {
            "limit": 1,
            "usage": 1
        },
        "pvc": {
            "limit": 1
        },
        "concurrency": {
            "limit": 1
        },
        "dubbing_concurrency": {
            "limit": 1
        },
        "music_concurrency": {
            "limit": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PlatformLimits::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
