<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PdfExportOptionsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "include_speakers": true,
        "include_timestamps": true,
        "format": "pdf",
        "segment_on_silence_longer_than_s": 1,
        "max_segment_duration_s": 1,
        "max_segment_chars": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\PdfExportOptions::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
