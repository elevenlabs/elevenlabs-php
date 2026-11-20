<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class NumericDistributionAggregateTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "count": 1,
        "sum": 1,
        "min": 1,
        "max": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\NumericDistributionAggregate::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
