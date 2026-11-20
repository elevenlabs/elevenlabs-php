<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Ivc\Requests;

use PHPUnit\Framework\TestCase;

class BodyAddVoiceV1VoicesAddPostTest extends TestCase
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
        }
    }
    JSON;

    $instance = \ElevenLabs\Voices\Ivc\Requests\BodyAddVoiceV1VoicesAddPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
