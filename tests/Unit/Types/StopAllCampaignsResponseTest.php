<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StopAllCampaignsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "stopped_campaign_ids": [
            "test-value"
        ],
        "stopping_campaign_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\StopAllCampaignsResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
