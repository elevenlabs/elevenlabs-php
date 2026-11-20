<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeakerResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "speaker_id": "test-value",
        "duration_secs": 1,
        "utterances": [
            {
                "start": 1,
                "end": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeakerResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
