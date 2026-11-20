<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AssetTranscriptionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "processing",
        "data": {
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
        },
        "updated_at_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AssetTranscription::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
