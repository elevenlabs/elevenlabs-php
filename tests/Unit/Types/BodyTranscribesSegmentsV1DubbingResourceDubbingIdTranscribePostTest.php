<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyTranscribesSegmentsV1DubbingResourceDubbingIdTranscribePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segments": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyTranscribesSegmentsV1DubbingResourceDubbingIdTranscribePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
