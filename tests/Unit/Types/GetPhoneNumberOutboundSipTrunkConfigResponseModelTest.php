<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetPhoneNumberOutboundSipTrunkConfigResponseModelTest extends TestCase
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
        "has_auth_credentials": true,
        "username": "test-value",
        "has_outbound_trunk": true,
        "enabled_codecs": [
            "G722/8000"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetPhoneNumberOutboundSipTrunkConfigResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
