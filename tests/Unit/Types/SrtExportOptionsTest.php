<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SrtExportOptionsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "max_characters_per_line": 1,
        "include_speakers": true,
        "include_timestamps": true,
        "format": "srt",
        "segment_on_silence_longer_than_s": 1,
        "max_segment_duration_s": 1,
        "max_segment_chars": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\SrtExportOptions::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
