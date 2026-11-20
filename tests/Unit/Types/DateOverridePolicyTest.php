<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DateOverridePolicyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_date": "test-value",
        "end_date": "test-value",
        "intervals": [
            {
                "start": "test-value",
                "end": "test-value"
            }
        ],
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DateOverridePolicy::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
