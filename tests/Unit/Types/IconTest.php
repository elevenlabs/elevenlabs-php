<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class IconTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "src": "test-value",
        "mimeType": "test-value",
        "sizes": [
            "test-value"
        ],
        "theme": "light"
    }
    JSON;

    $instance = \ElevenLabs\Types\Icon::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
