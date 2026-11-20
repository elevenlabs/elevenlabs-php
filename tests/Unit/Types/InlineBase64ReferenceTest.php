<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InlineBase64ReferenceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "inline_base64",
        "content_base64": "test-value",
        "mime_type": "image/jpeg"
    }
    JSON;

    $instance = \ElevenLabs\Types\InlineBase64Reference::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
