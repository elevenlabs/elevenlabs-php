<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SipTransferOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "sip_trunk",
        "config": {
            "transfer_destination": {
                "destination": "test-value",
                "type": "phone"
            },
            "type": "sip_cold_conference_transfer"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SipTransferOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
