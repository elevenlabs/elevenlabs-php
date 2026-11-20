<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SendTextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "try_trigger_generation": true,
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
        "flush": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SendText::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
