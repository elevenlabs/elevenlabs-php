<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ContentConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sexual": {
            "is_enabled": true,
            "threshold": 1
        },
        "violence": {
            "is_enabled": true,
            "threshold": 1
        },
        "harassment": {
            "is_enabled": true,
            "threshold": 1
        },
        "self_harm": {
            "is_enabled": true,
            "threshold": 1
        },
        "profanity": {
            "is_enabled": true,
            "threshold": 1
        },
        "religion_or_politics": {
            "is_enabled": true,
            "threshold": 1
        },
        "medical_and_legal_information": {
            "is_enabled": true,
            "threshold": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ContentConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
