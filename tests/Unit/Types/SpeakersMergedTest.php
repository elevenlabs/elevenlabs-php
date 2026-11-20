<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeakersMergedTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "speakers_merged",
        "from_speaker_id": "test-value",
        "to_speaker_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeakersMerged::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
