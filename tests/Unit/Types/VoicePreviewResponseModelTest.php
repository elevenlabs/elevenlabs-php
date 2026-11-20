<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoicePreviewResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio_base_64": "test-value",
        "generated_voice_id": "test-value",
        "media_type": "test-value",
        "duration_secs": 1,
        "language": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VoicePreviewResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
