<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InlineAudioReferenceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "inline_base64",
        "content_base64": "test-value",
        "mime_type": "audio/mpeg"
    }
    JSON;

    $instance = \ElevenLabs\Types\InlineAudioReference::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
