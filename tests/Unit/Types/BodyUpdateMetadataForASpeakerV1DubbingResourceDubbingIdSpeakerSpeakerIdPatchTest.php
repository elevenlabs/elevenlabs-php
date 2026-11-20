<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyUpdateMetadataForASpeakerV1DubbingResourceDubbingIdSpeakerSpeakerIdPatchTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "speaker_name": "test-value",
        "voice_id": "test-value",
        "voice_stability": 1,
        "voice_similarity": 1,
        "voice_style": 1,
        "languages": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyUpdateMetadataForASpeakerV1DubbingResourceDubbingIdSpeakerSpeakerIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
