<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TwilioMachineDetectionConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\TwilioMachineDetectionConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
