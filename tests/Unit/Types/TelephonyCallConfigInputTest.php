<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TelephonyCallConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\TelephonyCallConfigInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
