<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProvisionResellerWorkspaceSubscriptionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tier_id": "test-value",
        "billing_period": "monthly_period"
    }
    JSON;

    $instance = \ElevenLabs\Types\ProvisionResellerWorkspaceSubscription::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
