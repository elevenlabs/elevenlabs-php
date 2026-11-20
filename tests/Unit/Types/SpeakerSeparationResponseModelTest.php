<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeakerSeparationResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_id": "test-value",
        "sample_id": "test-value",
        "status": "not_started",
        "speakers": {
            "key": {
                "speaker_id": "test-value",
                "duration_secs": 1,
                "utterances": [
                    {
                        "start": 1,
                        "end": 1
                    }
                ]
            }
        },
        "selected_speaker_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeakerSeparationResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
