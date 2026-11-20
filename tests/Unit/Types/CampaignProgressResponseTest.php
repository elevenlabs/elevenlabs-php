<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CampaignProgressResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "leads": {
            "total": 1,
            "uncalled": 1,
            "leads_needing_attention": 1,
            "active": 1,
            "finished": 1,
            "finished_by_disposition": {
                "key": 1
            }
        },
        "conversations": {
            "scheduled": 1,
            "scheduled_by_type": {
                "key": 1
            },
            "awaiting_permission": 1,
            "in_progress": 1,
            "awaiting_analysis": 1
        },
        "next_call_time_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\CampaignProgressResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
