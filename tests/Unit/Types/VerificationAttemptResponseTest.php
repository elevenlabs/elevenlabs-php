<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VerificationAttemptResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\VerificationAttemptResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
