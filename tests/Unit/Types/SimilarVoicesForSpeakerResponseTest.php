<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SimilarVoicesForSpeakerResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voices": [
            {
                "voice_id": "test-value",
                "name": "test-value",
                "category": "generated",
                "description": "test-value",
                "preview_url": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SimilarVoicesForSpeakerResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
