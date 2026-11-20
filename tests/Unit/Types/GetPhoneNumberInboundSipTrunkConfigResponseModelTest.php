<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetPhoneNumberInboundSipTrunkConfigResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "allowed_addresses": [
            "test-value"
        ],
        "allowed_numbers": [
            "test-value"
        ],
        "media_encryption": "disabled",
        "has_auth_credentials": true,
        "username": "test-value",
        "remote_domains": [
            "test-value"
        ],
        "attributes_to_headers": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GetPhoneNumberInboundSipTrunkConfigResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
