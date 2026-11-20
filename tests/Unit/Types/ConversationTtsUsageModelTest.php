<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationTtsUsageModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "primary_tts_model": "test-value",
        "total_audio_output_seconds": 1,
        "total_characters": 1,
        "per_voice_usage": [
            {
                "voice_id": "test-value",
                "audio_output_seconds": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationTtsUsageModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
