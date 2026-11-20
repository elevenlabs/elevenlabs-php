<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Pvc\Verification\Requests;

use PHPUnit\Framework\TestCase;

class BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "files": [],
        "extra_text": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Voices\Pvc\Verification\Requests\BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
