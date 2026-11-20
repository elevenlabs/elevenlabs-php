<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PodcastBulletinModeTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "bulletin",
        "bulletin": {
            "host_voice_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PodcastBulletinMode::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
