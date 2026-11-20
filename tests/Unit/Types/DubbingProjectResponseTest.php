<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingProjectResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "project_id": "test-value",
        "status": "queued",
        "reference": "test-value",
        "source_language": "test-value",
        "model_id": "test-value",
        "media": {
            "filename": "test-value",
            "duration_s": 1,
            "has_video": true,
            "mime_type": "test-value"
        },
        "language_ids": [
            "test-value"
        ],
        "webhook_ids": [
            "test-value"
        ],
        "revision": 1,
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
    JSON;

    $instance = \ElevenLabs\Types\DubbingProjectResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
