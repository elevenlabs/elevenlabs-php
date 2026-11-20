<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeechHistoryItemResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "history_item_id": "test-value",
        "request_id": "test-value",
        "voice_id": "test-value",
        "model_id": "test-value",
        "voice_name": "test-value",
        "voice_category": "premade",
        "text": "test-value",
        "date_unix": 1,
        "character_count_change_from": 1,
        "character_count_change_to": 1,
        "content_type": "test-value",
        "state": "test-value",
        "settings": {
            "key": "test-value"
        },
        "share_link_id": "test-value",
        "source": "TTS",
        "alignments": {
            "alignment": {
                "characters": [
                    "test-value"
                ],
                "character_start_times_seconds": [
                    1
                ],
                "character_end_times_seconds": [
                    1
                ]
            },
            "normalized_alignment": {
                "characters": [
                    "test-value"
                ],
                "character_start_times_seconds": [
                    1
                ],
                "character_end_times_seconds": [
                    1
                ]
            }
        },
        "dialogue": [
            {
                "text": "test-value",
                "voice_id": "test-value",
                "voice_name": "test-value"
            }
        ],
        "output_format": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeechHistoryItemResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
