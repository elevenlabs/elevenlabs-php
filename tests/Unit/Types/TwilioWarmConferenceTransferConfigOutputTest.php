<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TwilioWarmConferenceTransferConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
