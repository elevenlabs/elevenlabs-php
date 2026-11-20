<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationTurnMetricsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "metrics": {
            "key": {
                "elapsed_time": 1
            }
        },
        "convai_asr_provider": "test-value",
        "convai_tts_model": "test-value",
        "convai_tts_cascade": "test-value",
        "voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationTurnMetrics::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
