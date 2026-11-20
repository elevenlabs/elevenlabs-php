<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TranslateInputAudioChunkTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "input_audio_chunk",
        "audio_base_64": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TranslateInputAudioChunk::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
