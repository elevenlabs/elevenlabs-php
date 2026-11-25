<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubtitlingCommittedSubtitleTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "committed_subtitle",
        "cue_index": 1,
        "lines": [
            "test-value"
        ],
        "start_ms": 1,
        "end_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\SubtitlingCommittedSubtitle::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
