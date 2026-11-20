<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeechEngineSummaryResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "speech_engine_id": "test-value",
        "name": "test-value",
        "voice_id": "test-value",
        "created_at_unix_secs": 1,
        "updated_at_unix_secs": 1,
        "tags": [
            "test-value"
        ],
        "access_info": {
            "is_creator": true,
            "creator_name": "test-value",
            "creator_email": "test-value",
            "role": "admin",
            "anonymous_access_level_override": "admin",
            "access_source": "creator"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeechEngineSummaryResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
