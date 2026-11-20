<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BaseTurnConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "turn_timeout": 1,
        "initial_wait_time": 1,
        "silence_end_call_timeout": 1,
        "turn_eagerness": "patient",
        "spelling_patience": "auto",
        "speculative_turn": true,
        "retranscribe_on_turn_timeout": true,
        "turn_model": "turn_v2",
        "interruption_ignore_terms": [
            "test-value"
        ],
        "interruption_ignore_term_languages": [
            "test-value"
        ],
        "merge_with_default_ignore_terms": true,
        "transcribe_on_disabled_interruptions": true
    }
    JSON;

    $instance = \ElevenLabs\Types\BaseTurnConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
