<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingBulkTargetSegmentUpdateResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segments": [
            {
                "id": "test-value",
                "speaker_id": "test-value",
                "start_s": 1,
                "end_s": 1,
                "source_text": "test-value",
                "translation": "test-value"
            }
        ],
        "revision": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingBulkTargetSegmentUpdateResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
