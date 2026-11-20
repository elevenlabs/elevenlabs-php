<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\AudioNative\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url": "test-value",
        "author": "test-value",
        "title": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
