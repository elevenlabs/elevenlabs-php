<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BehaviorOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "verbosity": "auto",
        "output_format": "mp3_22050_32",
        "interaction_budget": "realtime"
    }
    JSON;

    $instance = \ElevenLabs\Types\BehaviorOverride::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
