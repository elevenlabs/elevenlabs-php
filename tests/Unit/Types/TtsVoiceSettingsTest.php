<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TtsVoiceSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "stability": 0,
        "similarity_boost": 0,
        "style": 0,
        "use_speaker_boost": true,
        "speed": 0.7
    }
    JSON;

    $instance = \ElevenLabs\Types\TtsVoiceSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
