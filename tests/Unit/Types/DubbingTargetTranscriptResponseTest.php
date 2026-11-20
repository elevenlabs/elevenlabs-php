<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingTargetTranscriptResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_language": "test-value",
        "target_language": "test-value",
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

    $instance = \ElevenLabs\Types\DubbingTargetTranscriptResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
