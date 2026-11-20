<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Requests;

use PHPUnit\Framework\TestCase;

class BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "new_name": "test-value",
        "bookmarked": true
    }
    JSON;

    $instance = \ElevenLabs\Voices\Requests\BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
