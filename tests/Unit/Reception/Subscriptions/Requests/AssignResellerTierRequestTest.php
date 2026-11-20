<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Reception\Subscriptions\Requests;

use PHPUnit\Framework\TestCase;

class AssignResellerTierRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tier_id": "test-value",
        "billing_period": "monthly_period",
        "idempotency_key": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Reception\Subscriptions\Requests\AssignResellerTierRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
