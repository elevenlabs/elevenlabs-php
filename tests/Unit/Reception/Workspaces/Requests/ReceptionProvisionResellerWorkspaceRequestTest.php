<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Reception\Workspaces\Requests;

use PHPUnit\Framework\TestCase;

class ReceptionProvisionResellerWorkspaceRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "business_name": "test-value",
        "vertical": "salon_barbershop",
        "charge_customer": true,
        "subscription": {
            "tier_id": "test-value",
            "billing_period": "monthly_period"
        },
        "phone_number": "test-value",
        "members": [
            {
                "email": "test-value",
                "role": "workspace_admin"
            }
        ],
        "complete_onboarding": true,
        "idempotency_key": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Reception\Workspaces\Requests\ReceptionProvisionResellerWorkspaceRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
