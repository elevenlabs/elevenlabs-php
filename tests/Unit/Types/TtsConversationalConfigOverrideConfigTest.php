<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TtsConversationalConfigOverrideConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model_id": true,
        "voice_id": true,
        "supported_voices": true,
        "stability": true,
        "speed": true,
        "similarity_boost": true,
        "clone_strength": true,
        "pronunciation_dictionary_locators": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TtsConversationalConfigOverrideConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
