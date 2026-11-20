<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Dubbing\Project\Transcript\Requests;

use PHPUnit\Framework\TestCase;

class DubbingBulkSegmentUpdateRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segments": {
            "key": {
                "text": "test-value",
                "speaker_id": "test-value",
                "start_s": 1,
                "end_s": 1
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingBulkSegmentUpdateRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
