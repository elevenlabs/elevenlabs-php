<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\PhoneNumbers\Requests;

use PHPUnit\Framework\TestCase;

class UpdatePhoneNumberRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "label": "test-value",
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
        },
        "livekit_stack": "standard",
        "store_sip_messages": true,
        "environment": "test-value",
        "branch_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\PhoneNumbers\Requests\UpdatePhoneNumberRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
