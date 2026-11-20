<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CallingPeriodPolicyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "weekdays": [
            1
        ],
        "intervals": [
            {
                "start": "test-value",
                "end": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\CallingPeriodPolicy::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
