<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InitializeConnectionVoiceSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "stability": 1,
        "similarity_boost": 1,
        "style": 1,
        "use_speaker_boost": true,
        "speed": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\InitializeConnectionVoiceSettings::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
