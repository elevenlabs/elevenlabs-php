<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateSipTrunkPhoneNumberRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number": "test-value",
        "label": "test-value",
        "supports_inbound": true,
        "supports_outbound": true,
        "provider": "sip_trunk",
        "agent_id": "test-value",
        "inbound_trunk_config": {
            "allowed_addresses": [
                "test-value"
            ],
            "allowed_numbers": [
                "test-value"
            ],
            "media_encryption": "disabled",
            "credentials": {
                "username": "test-value",
                "password": "test-value"
            },
            "remote_domains": [
                "test-value"
            ],
            "attributes_to_headers": {
                "key": "test-value"
            }
        },
        "outbound_trunk_config": {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateSipTrunkPhoneNumberRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
