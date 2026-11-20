<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TtsConversationalConfigOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model_id": "eleven_turbo_v2",
        "voice_id": "test-value",
        "supported_voices": [
            {
                "label": "test-value",
                "voice_id": "test-value",
                "description": "test-value",
                "language": "test-value",
                "model_family": "turbo",
                "optimize_streaming_latency": 0,
                "stability": 0,
                "speed": 0.7,
                "similarity_boost": 0,
                "clone_strength": 0
            }
        ],
        "stability": 1,
        "speed": 1,
        "similarity_boost": 1,
        "clone_strength": 1,
        "pronunciation_dictionary_locators": [
            {
                "pronunciation_dictionary_id": "test-value",
                "version_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\TtsConversationalConfigOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
