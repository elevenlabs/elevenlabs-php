<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FineTuningResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_allowed_to_fine_tune": true,
        "state": {
            "key": "not_started"
        },
        "verification_failures": [
            "test-value"
        ],
        "verification_attempts_count": 1,
        "manual_verification_requested": true,
        "language": "test-value",
        "progress": {
            "key": 1
        },
        "message": {
            "key": "test-value"
        },
        "dataset_duration_seconds": 1,
        "verification_attempts": [
            {
                "text": "test-value",
                "date_unix": 1,
                "accepted": true,
                "similarity": 1,
                "levenshtein_distance": 1,
                "recording": {
                    "recording_id": "test-value",
                    "mime_type": "test-value",
                    "size_bytes": 1,
                    "upload_date_unix": 1,
                    "transcription": "test-value"
                }
            }
        ],
        "slice_ids": [
            "test-value"
        ],
        "manual_verification": {
            "extra_text": "test-value",
            "request_time_unix": 1,
            "files": [
                {
                    "file_id": "test-value",
                    "file_name": "test-value",
                    "mime_type": "test-value",
                    "size_bytes": 1,
                    "upload_date_unix": 1
                }
            ]
        },
        "max_verification_attempts": 1,
        "next_max_verification_attempts_reset_unix_ms": 1,
        "finetuning_state": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\FineTuningResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
