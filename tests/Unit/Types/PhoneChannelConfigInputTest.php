<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PhoneChannelConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "channel": "phone",
        "agent_phone_number_id": "test-value",
        "mode_config": {
            "ringing_timeout_secs": 1,
            "twilio_call_recording_enabled": true,
            "twilio_machine_detection": {
                "mode": "enable",
                "actions": [
                    {
                        "action": "hang_up",
                        "answered_by": [
                            "human"
                        ]
                    }
                ]
            },
            "mode": "voice"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PhoneChannelConfigInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
