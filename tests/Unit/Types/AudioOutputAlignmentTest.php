<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioOutputAlignmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chars": [
            "test-value"
        ],
        "char_start_times_ms": [
            1
        ],
        "char_durations_ms": [
            1
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioOutputAlignment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
