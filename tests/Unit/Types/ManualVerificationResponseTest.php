<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ManualVerificationResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\ManualVerificationResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
