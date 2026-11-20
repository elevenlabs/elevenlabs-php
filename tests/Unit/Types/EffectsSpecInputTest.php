<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EffectsSpecInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "filter_preset_id": "test-value",
        "distance": 0,
        "environment_id": "test-value",
        "background_noise_id": "test-value",
        "send_level": 0,
        "pan": -1
    }
    JSON;

    $instance = \ElevenLabs\Types\EffectsSpecInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
