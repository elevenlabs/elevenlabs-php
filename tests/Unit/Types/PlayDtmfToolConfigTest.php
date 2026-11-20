<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlayDtmfToolConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "system_tool_type": "play_keypad_touch_tone",
        "use_out_of_band_dtmf": true,
        "suppress_turn_after_dtmf": true
    }
    JSON;

    $instance = \ElevenLabs\Types\PlayDtmfToolConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
