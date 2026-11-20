<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationAsrUsageModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "asr_model": "test-value",
        "total_transcription_calls": 1,
        "total_audio_input_seconds": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationAsrUsageModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
