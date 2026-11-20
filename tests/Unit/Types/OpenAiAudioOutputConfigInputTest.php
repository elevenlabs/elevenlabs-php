<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAiAudioOutputConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "format": {
            "type": "audio/pcm"
        },
        "voice": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAiAudioOutputConfigInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
