<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Pvc\Requests;

use PHPUnit\Framework\TestCase;

class CreatePvcVoiceRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "language": "test-value",
        "description": "test-value",
        "labels": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Voices\Pvc\Requests\CreatePvcVoiceRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
