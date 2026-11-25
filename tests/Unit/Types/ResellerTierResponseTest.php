<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResellerTierResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tier_id": "test-value",
        "display_name": "test-value",
        "currency": "USD",
        "tier_economics": {
            "monthly_price_usd": 1,
            "annual_price_usd": 1,
            "included_minutes_per_month": 1,
            "overage_price_per_minute_usd": 1,
            "max_phone_numbers": 1,
            "concurrent_calls": 1,
            "max_active_locations": 1,
            "max_customer_facing_agents": 1,
            "max_team_members": 1,
            "assistant_daily_messages": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ResellerTierResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
