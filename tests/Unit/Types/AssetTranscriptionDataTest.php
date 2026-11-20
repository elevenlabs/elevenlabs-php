<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AssetTranscriptionDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language_code": "test-value",
        "text": "test-value",
        "words": [
            "test-value"
        ],
        "word_start_times_ms": [
            1
        ],
        "word_end_times_ms": [
            1
        ],
        "word_speaker_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AssetTranscriptionData::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
