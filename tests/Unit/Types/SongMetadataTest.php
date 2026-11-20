<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SongMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value",
        "genres": [
            "test-value"
        ],
        "languages": [
            "test-value"
        ],
        "is_explicit": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SongMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
