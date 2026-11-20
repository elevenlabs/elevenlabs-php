<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingLanguageListResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "languages": [
            {
                "language_id": "test-value",
                "project_id": "test-value",
                "target_language": "test-value",
                "status": "queued",
                "model_id": "test-value",
                "voice_settings": {
                    "cloning_strength": 0
                },
                "outputs": {
                    "lossless_audio": "test-value",
                    "subtitles": "test-value"
                },
                "revision": 1,
                "output_revision": 1,
                "error": {
                    "code": "test-value",
                    "message": "test-value",
                    "retryable": true
                },
                "warnings": [
                    {
                        "type": "voices_not_permitted",
                        "speaker_ids": [
                            "test-value"
                        ],
                        "message": "test-value"
                    }
                ],
                "created_at": "2023-01-01T12:34:56Z",
                "updated_at": "2023-01-01T12:34:56Z"
            }
        ],
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingLanguageListResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
