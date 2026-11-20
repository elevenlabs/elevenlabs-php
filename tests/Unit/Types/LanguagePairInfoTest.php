<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LanguagePairInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\LanguagePairInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
