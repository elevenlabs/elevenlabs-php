<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "stability": 0,
        "use_speaker_boost": true,
        "similarity_boost": 0,
        "style": 1,
        "speed": 1,
        "clone_strength": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
