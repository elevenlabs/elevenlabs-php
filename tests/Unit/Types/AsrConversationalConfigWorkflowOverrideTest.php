<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AsrConversationalConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "quality": "high",
        "provider": "elevenlabs",
        "user_input_audio_format": "pcm_8000",
        "keywords": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AsrConversationalConfigWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
