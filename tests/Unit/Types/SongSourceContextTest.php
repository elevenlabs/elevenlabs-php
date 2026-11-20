<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SongSourceContextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "song",
        "song_id": "test-value",
        "chat_id": "test-value",
        "title": "test-value",
        "description": "test-value",
        "genres": [
            "test-value"
        ],
        "languages": [
            "test-value"
        ],
        "is_explicit": true,
        "bpm": 1,
        "generation_settings": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SongSourceContext::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
