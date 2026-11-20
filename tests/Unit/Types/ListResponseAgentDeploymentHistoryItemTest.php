<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListResponseAgentDeploymentHistoryItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "meta": {
            "total": 1,
            "page": 1,
            "page_size": 1
        },
        "results": [
            {
                "id": "test-value",
                "traffic_percentage_branch_id_map": {
                    "key": 1
                },
                "deployed_at_unix_secs": 1,
                "is_active": true,
                "source": "manual",
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ListResponseAgentDeploymentHistoryItem::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
