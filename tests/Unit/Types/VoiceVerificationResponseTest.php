<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceVerificationResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "requires_verification": true,
        "is_verified": true,
        "verification_failures": [
            "test-value"
        ],
        "verification_attempts_count": 1,
        "language": "test-value",
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
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceVerificationResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
