<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BatchCallingCampaignInformationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "campaign_id": "test-value",
        "campaign_lead_id": "test-value",
        "cold_attempt": 1,
        "conversation_type": "initial"
    }
    JSON;

    $instance = \ElevenLabs\Types\BatchCallingCampaignInformation::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
