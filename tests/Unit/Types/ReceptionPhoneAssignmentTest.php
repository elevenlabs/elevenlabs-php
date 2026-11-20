<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionPhoneAssignmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number": "test-value",
        "is_byo": true,
        "provider": "twilio",
        "nanp_area_code": 1,
        "customer_facing_agent_id": "test-value",
        "deactivated_at_unix": 1,
        "deactivation_reason": "tier_downgrade",
        "regulatory_status": "held",
        "regulatory_number_type": "local",
        "regulatory_country": "test-value",
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1,
        "is_active": true,
        "accepts_public_calls": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionPhoneAssignment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
