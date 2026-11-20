<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CampaignFollowUpRequestsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "callbacks": {
            "requested": 1,
            "requested_by_disposition": {
                "key": 1
            },
            "distinct_leads": 1
        },
        "redirects": {
            "requested": 1,
            "requested_by_disposition": {
                "key": 1
            },
            "distinct_leads": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CampaignFollowUpRequestsResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
