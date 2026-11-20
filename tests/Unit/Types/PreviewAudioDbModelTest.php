<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PreviewAudioDbModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_id": "test-value",
        "text": "test-value",
        "audio_url": "test-value",
        "hls_manifest_url": "test-value",
        "dash_manifest_url": "test-value",
        "is_auto_generated": true,
        "generated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\PreviewAudioDbModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
