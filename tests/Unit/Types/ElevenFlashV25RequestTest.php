<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ElevenFlashV25RequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "text": "test-value",
        "voice": "test-value",
        "output_format": "mp3_22050_32",
        "pronunciation_dictionary_locators": [
            {
                "pronunciation_dictionary_id": "test-value",
                "version_id": "test-value"
            }
        ],
        "model_id": "eleven_flash_v2_5",
        "language_code": "test-value",
        "voice_settings": {
            "stability": 0,
            "similarity_boost": 0,
            "speed": 0.7
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ElevenFlashV25Request::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
