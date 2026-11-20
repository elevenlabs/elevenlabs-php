<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ScribeInsufficientAudioActivityErrorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "insufficient_audio_activity",
        "error": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ScribeInsufficientAudioActivityError::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
