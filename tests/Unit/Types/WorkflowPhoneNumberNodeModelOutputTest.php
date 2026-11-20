<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowPhoneNumberNodeModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "custom_sip_headers": [
            {
                "type": "static",
                "key": "test-value",
                "value": "test-value"
            }
        ],
        "transfer_destination": {
            "type": "phone",
            "phone_number": "test-value"
        },
        "transfer_type": "blind",
        "sip_refer_play_dialtone": true,
        "uui": {
            "data": "test-value",
            "protocol_discriminator": "test-value",
            "protocol_discriminator_mode": "prefix"
        },
        "post_dial_digits": {
            "type": "static",
            "value": "test-value"
        },
        "type": "phone_number",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "provider_configs": [
            {
                "type": "twilio",
                "config": {
                    "transfer_destination": {
                        "destination": "test-value",
                        "type": "phone"
                    },
                    "post_dial_digits": {
                        "type": "static",
                        "value": "test-value"
                    },
                    "type": "twilio_warm_conference_transfer"
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
