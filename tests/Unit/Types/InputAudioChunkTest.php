<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InputAudioChunkTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "test-value",
        "audio_base_64": "test-value",
        "commit": true,
        "previous_text": "test-value",
        "keyterm_library": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\InputAudioChunk::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
