<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MusicExploreSongSourceContextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "music_explore_song",
        "music_explore_song_id": "test-value",
        "title": "test-value",
        "description": "test-value",
        "bpm": 1,
        "vocals": "test-value",
        "lyrics": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\MusicExploreSongSourceContext::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
