<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PairedLanguagesResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "pair",
        "language_pairs": [
            {
                "source_language": {
                    "code": "test-value",
                    "label": "test-value"
                },
                "destination_languages": [
                    {
                        "code": "test-value",
                        "label": "test-value"
                    }
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\PairedLanguagesResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
