<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SipColdReferTransferConfigInputTest extends TestCase
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
            "destination": "test-value",
            "type": "phone"
        },
        "type": "sip_cold_refer_transfer",
        "uui": {
            "data": "test-value",
            "protocol_discriminator": "test-value",
            "protocol_discriminator_mode": "prefix"
        },
        "play_dialtone": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SipColdReferTransferConfigInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
