<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SimilarVoiceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_id": "test-value",
        "name": "test-value",
        "category": "generated",
        "description": "test-value",
        "preview_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SimilarVoice::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
