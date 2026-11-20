<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Collections\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateVoiceCollectionV1VoicesCollectionsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "icon": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Voices\Collections\Requests\BodyCreateVoiceCollectionV1VoicesCollectionsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
