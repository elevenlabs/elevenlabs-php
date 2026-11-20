<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Dubbing\Requests;

use PHPUnit\Framework\TestCase;

class BodyDubAVideoOrAnAudioFileV1DubbingPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "source_url": "test-value",
        "source_lang": "test-value",
        "target_lang": "test-value",
        "target_accent": "test-value",
        "num_speakers": 1,
        "watermark": true,
        "start_time": 1,
        "end_time": 1,
        "highest_resolution": true,
        "drop_background_audio": true,
        "use_profanity_filter": true,
        "dubbing_studio": true,
        "disable_voice_cloning": true,
        "mode": "automatic",
        "csv_fps": 1
    }
    JSON;

    $instance = \ElevenLabs\Dubbing\Requests\BodyDubAVideoOrAnAudioFileV1DubbingPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
