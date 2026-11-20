<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingTranscriptSegmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "text": "test-value",
        "speaker_id": "test-value",
        "start_s": 1,
        "end_s": 1,
        "external_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingTranscriptSegment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
