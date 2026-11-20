<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClipAnimationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enter_effect": "none",
        "enter_duration_ms": 1,
        "exit_effect": "none",
        "exit_duration_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ClipAnimation::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
