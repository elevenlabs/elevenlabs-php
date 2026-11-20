<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSegmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_id": "test-value",
        "start_time_seconds": 1,
        "end_time_seconds": 1,
        "character_start_index": 1,
        "character_end_index": 1,
        "dialogue_input_index": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSegment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
