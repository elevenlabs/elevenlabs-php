<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\AudioNative\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "auto_convert": true,
        "auto_publish": true
    }
    JSON;

    $instance = \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
