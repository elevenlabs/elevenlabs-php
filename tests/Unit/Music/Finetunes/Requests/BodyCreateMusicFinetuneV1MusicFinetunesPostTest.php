<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Music\Finetunes\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateMusicFinetuneV1MusicFinetunesPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "primary_genre": "test-value",
        "files": [],
        "tags": [
            "test-value"
        ],
        "visibility": "private",
        "model_id": "music_v1"
    }
    JSON;

    $instance = \ElevenLabs\Music\Finetunes\Requests\BodyCreateMusicFinetuneV1MusicFinetunesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
