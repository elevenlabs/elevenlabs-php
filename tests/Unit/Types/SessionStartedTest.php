<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SessionStartedTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "session_started",
        "session_id": "test-value",
        "config": {
            "sample_rate": 1,
            "audio_format": "pcm_8000",
            "language_code": "test-value",
            "secondary_languages": [
                "test-value"
            ],
            "timestamps_granularity": "none",
            "vad_commit_strategy": true,
            "vad_silence_threshold_secs": 1,
            "vad_threshold": 1,
            "min_speech_duration_ms": 1,
            "min_silence_duration_ms": 1,
            "max_tokens_to_recompute": 1,
            "model_id": "scribe_v2_realtime",
            "disable_logging": true,
            "include_timestamps": true,
            "include_language_detection": true,
            "filter_background_audio": true,
            "keyterms": [
                "test-value"
            ],
            "no_verbatim": true,
            "entity_detection": [
                "test-value"
            ],
            "entity_redaction": [
                "test-value"
            ],
            "entity_redaction_mode": "test-value",
            "keepalive_interval_ms": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SessionStarted::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
