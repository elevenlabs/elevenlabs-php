<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Collections\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateVoiceCollectionV1VoicesCollectionsCollectionIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "icon": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Voices\Collections\Requests\BodyUpdateVoiceCollectionV1VoicesCollectionsCollectionIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
