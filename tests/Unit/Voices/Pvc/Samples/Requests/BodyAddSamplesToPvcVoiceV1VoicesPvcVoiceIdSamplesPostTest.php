<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Pvc\Samples\Requests;

use PHPUnit\Framework\TestCase;

class BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "files": [],
        "remove_background_noise": true
    }
    JSON;

    $instance = \ElevenLabs\Voices\Pvc\Samples\Requests\BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
