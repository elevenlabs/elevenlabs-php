<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingSourceSegmentUpdateResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segment": {
            "id": "test-value",
            "text": "test-value",
            "speaker_id": "test-value",
            "start_s": 1,
            "end_s": 1,
            "external_id": "test-value"
        },
        "revision": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingSourceSegmentUpdateResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
