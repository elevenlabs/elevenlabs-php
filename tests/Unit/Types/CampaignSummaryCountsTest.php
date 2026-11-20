<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CampaignSummaryCountsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "leads": 1,
        "terminal_leads": 1,
        "open_attention": 1,
        "delivery": {
            "sent": 1,
            "delivered": 1,
            "read": 1,
            "replied": 1,
            "failed": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CampaignSummaryCounts::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
