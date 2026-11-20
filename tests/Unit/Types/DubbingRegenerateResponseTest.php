<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingRegenerateResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "regenerated_segment_ids": [
            "test-value"
        ],
        "regenerated_seconds": 1,
        "charged_seconds": 1,
        "free_regeneration_seconds_remaining": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingRegenerateResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
