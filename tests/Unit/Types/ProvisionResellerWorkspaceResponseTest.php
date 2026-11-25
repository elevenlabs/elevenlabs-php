<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProvisionResellerWorkspaceResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "workspace_id": "test-value",
        "business_name": "test-value",
        "billing_tier": "test-value",
        "receptionist_count": 1,
        "calls_last_30_days": 1,
        "created_at_unix": 1,
        "subscription": {
            "tier_id": "test-value",
            "billing_period": "monthly_period",
            "billing_period_end_unix": 1,
            "cancel_at_unix": 1,
            "pending_downgrade_tier": "test-value",
            "pending_downgrade_at_unix": 1
        },
        "charge_customer": true,
        "has_payment_issue": true,
        "onboarding_completed_at_unix": 1,
        "member_results": [
            {
                "email": "test-value",
                "outcome": "invited",
                "error_status": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ProvisionResellerWorkspaceResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
