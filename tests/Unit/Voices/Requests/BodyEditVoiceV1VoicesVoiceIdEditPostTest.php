<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Requests;

use PHPUnit\Framework\TestCase;

class BodyEditVoiceV1VoicesVoiceIdEditPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "files": [],
        "remove_background_noise": true,
        "description": "test-value",
        "labels": {
            "key": "test-value"
        },
        "moderate_metadata": true
    }
    JSON;

    $instance = \ElevenLabs\Voices\Requests\BodyEditVoiceV1VoicesVoiceIdEditPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
