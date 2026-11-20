<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSamplePreviewResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio_base_64": "test-value",
        "voice_id": "test-value",
        "sample_id": "test-value",
        "media_type": "test-value",
        "duration_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSamplePreviewResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
