<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BackgroundSoundConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "preset",
        "source_id": "office2",
        "volume": 1,
        "crossfade_loop": true
    }
    JSON;

    $instance = \ElevenLabs\Types\BackgroundSoundConfigWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
