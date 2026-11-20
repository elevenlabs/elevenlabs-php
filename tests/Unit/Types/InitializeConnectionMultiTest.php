<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InitializeConnectionMultiTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": " ",
        "voice_settings": {
            "stability": 1,
            "similarity_boost": 1,
            "style": 1,
            "use_speaker_boost": true,
            "speed": 1
        },
        "generation_config": {
            "chunk_length_schedule": [
                1
            ]
        },
        "pronunciation_dictionary_locators": [
            {
                "pronunciation_dictionary_id": "test-value",
                "version_id": "test-value"
            }
        ],
        "xi_api_key": "test-value",
        "authorization": "test-value",
        "context_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\InitializeConnectionMulti::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
