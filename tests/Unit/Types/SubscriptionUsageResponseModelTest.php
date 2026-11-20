<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubscriptionUsageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "rollover_credits_quota": 1,
        "subscription_cycle_credits_quota": 1,
        "manually_gifted_credits_quota": 1,
        "payg_credits_quota": 1,
        "rollover_credits_used": 1,
        "subscription_cycle_credits_used": 1,
        "manually_gifted_credits_used": 1,
        "payg_credits_used": 1,
        "paid_usage_based_credits_used": 1,
        "actual_reported_credits": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\SubscriptionUsageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
