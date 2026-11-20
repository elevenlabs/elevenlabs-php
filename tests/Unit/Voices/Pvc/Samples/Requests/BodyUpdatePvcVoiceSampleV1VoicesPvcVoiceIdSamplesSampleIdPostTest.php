<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Pvc\Samples\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "remove_background_noise": true,
        "selected_speaker_ids": [
            "test-value"
        ],
        "trim_start_time": 1,
        "trim_end_time": 1,
        "file_name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Voices\Pvc\Samples\Requests\BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
