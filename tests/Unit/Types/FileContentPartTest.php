<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FileContentPartTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "file",
        "source": {
            "type": "base64",
            "filename": "test-value",
            "media_type": "image/png",
            "data": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\FileContentPart::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
