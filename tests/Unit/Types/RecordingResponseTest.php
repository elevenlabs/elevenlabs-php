<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RecordingResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "recording_id": "test-value",
        "mime_type": "test-value",
        "size_bytes": 1,
        "upload_date_unix": 1,
        "transcription": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\RecordingResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
