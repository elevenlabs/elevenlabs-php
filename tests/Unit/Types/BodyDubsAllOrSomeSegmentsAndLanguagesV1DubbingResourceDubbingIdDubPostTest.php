<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyDubsAllOrSomeSegmentsAndLanguagesV1DubbingResourceDubbingIdDubPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segments": [
            "test-value"
        ],
        "languages": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyDubsAllOrSomeSegmentsAndLanguagesV1DubbingResourceDubbingIdDubPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
