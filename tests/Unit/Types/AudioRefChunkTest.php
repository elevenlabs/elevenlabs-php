<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioRefChunkTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "song_id": "test-value",
        "range": {
            "start_ms": 1,
            "end_ms": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioRefChunk::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
