<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TurnConfigOverrideConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "soft_timeout_config": {
            "message": true,
            "additional_soft_timeout_messages": true
        },
        "noisy_environment_message": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TurnConfigOverrideConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
