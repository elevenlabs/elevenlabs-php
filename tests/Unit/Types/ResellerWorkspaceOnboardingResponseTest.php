<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResellerWorkspaceOnboardingResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "onboarding_completed_at_unix": 1,
        "customer_facing_agent_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ResellerWorkspaceOnboardingResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
