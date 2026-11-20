<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyCreateANewSpeakerV1DubbingResourceDubbingIdSpeakerPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "speaker_name": "test-value",
        "voice_id": "test-value",
        "voice_stability": 1,
        "voice_similarity": 1,
        "voice_style": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyCreateANewSpeakerV1DubbingResourceDubbingIdSpeakerPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
