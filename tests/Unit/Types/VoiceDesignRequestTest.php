<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceDesignRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_description": "test-value",
        "text": "test-value",
        "auto_generate_text": true,
        "loudness": -1,
        "quality": -1,
        "seed": 0,
        "guidance_scale": 0,
        "should_enhance": true
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceDesignRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
