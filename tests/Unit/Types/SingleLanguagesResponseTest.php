<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SingleLanguagesResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "single",
        "languages": [
            {
                "code": "test-value",
                "label": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SingleLanguagesResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
