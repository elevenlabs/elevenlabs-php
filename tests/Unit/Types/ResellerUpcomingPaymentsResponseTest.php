<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResellerUpcomingPaymentsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "payments": [
            {
                "workspace_id": "test-value",
                "workspace_name": "test-value",
                "subscription": {
                    "tier_id": "test-value",
                    "billing_period": "monthly_period",
                    "billing_period_end_unix": 1,
                    "cancel_at_unix": 1,
                    "pending_downgrade_tier": "test-value",
                    "pending_downgrade_at_unix": 1
                },
                "plan_usd": 1,
                "overage_so_far_usd": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ResellerUpcomingPaymentsResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
