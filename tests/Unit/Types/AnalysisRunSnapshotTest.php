<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AnalysisRunSnapshotTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "price": 1,
        "charge": 1,
        "price_per_feature": {
            "key": 1
        },
        "charge_per_feature": {
            "key": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AnalysisRunSnapshot::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
