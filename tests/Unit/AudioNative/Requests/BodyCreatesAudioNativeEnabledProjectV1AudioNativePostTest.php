<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\AudioNative\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreatesAudioNativeEnabledProjectV1AudioNativePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "image": "test-value",
        "author": "test-value",
        "title": "test-value",
        "small": true,
        "text_color": "test-value",
        "background_color": "test-value",
        "sessionization": 1,
        "voice_id": "test-value",
        "model_id": "test-value",
        "auto_convert": true,
        "apply_text_normalization": "auto",
        "pronunciation_dictionary_locators": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\AudioNative\Requests\BodyCreatesAudioNativeEnabledProjectV1AudioNativePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
