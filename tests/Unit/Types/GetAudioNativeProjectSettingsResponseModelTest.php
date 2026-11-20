<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAudioNativeProjectSettingsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "snapshot_id": "test-value",
        "settings": {
            "title": "test-value",
            "image": "test-value",
            "author": "test-value",
            "small": true,
            "text_color": "test-value",
            "background_color": "test-value",
            "sessionization": 1,
            "audio_path": "test-value",
            "audio_url": "test-value",
            "status": "processing"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAudioNativeProjectSettingsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
