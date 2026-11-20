<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MetronomeUsageColumnFilterTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "column": "model",
        "operation": "eq",
        "values": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\MetronomeUsageColumnFilter::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
