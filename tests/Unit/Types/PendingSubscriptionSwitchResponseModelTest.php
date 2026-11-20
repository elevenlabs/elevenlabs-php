<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PendingSubscriptionSwitchResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "change",
        "next_tier": "free",
        "next_billing_period": "monthly_period",
        "timestamp_seconds": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\PendingSubscriptionSwitchResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
