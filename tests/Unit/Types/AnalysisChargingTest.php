<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AnalysisChargingTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "total": {
            "price": 1,
            "charge": 1,
            "runs": 1,
            "price_per_feature": {
                "key": 1
            },
            "charge_per_feature": {
                "key": 1
            }
        },
        "last_run": {
            "price": 1,
            "charge": 1,
            "price_per_feature": {
                "key": 1
            },
            "charge_per_feature": {
                "key": 1
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AnalysisCharging::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
