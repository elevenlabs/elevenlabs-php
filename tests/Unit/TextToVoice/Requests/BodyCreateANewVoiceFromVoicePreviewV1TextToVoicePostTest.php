<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\TextToVoice\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_name": "test-value",
        "voice_description": "test-value",
        "generated_voice_id": "test-value",
        "labels": {
            "key": "test-value"
        },
        "played_not_selected_voice_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\TextToVoice\Requests\BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
