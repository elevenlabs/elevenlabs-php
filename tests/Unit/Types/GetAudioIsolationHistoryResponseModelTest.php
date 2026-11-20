<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAudioIsolationHistoryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "items": [
            {
                "id": "test-value",
                "title": "test-value",
                "created_at_unix": 1,
                "format": "test-value",
                "duration_seconds": 1,
                "download_url": "test-value",
                "icon_url": "test-value",
                "source_video_url": "test-value",
                "supports_video": true,
                "processing": true,
                "video_processing_failed": true,
                "preview_b64": "test-value"
            }
        ],
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAudioIsolationHistoryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
