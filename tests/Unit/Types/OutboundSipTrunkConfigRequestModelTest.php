<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OutboundSipTrunkConfigRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "address": "test-value",
        "transport": "auto",
        "media_encryption": "disabled",
        "headers": {
            "key": "test-value"
        },
        "attributes_to_headers": {
            "key": "test-value"
        },
        "credentials": {
            "username": "test-value",
            "password": "test-value"
        },
        "enabled_codecs": [
            "G722/8000"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\OutboundSipTrunkConfigRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
