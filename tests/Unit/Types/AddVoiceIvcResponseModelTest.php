<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AddVoiceIvcResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "voice_id": "test-value",
        "requires_verification": true,
        "library_voice_match": {
            "library_voice_id": "test-value",
            "public_owner_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AddVoiceIvcResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
