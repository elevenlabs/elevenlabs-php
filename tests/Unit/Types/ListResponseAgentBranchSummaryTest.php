<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListResponseAgentBranchSummaryTest extends TestCase
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
                "name": "test-value",
                "agent_id": "test-value",
                "description": "test-value",
                "created_at": 1,
                "last_committed_at": 1,
                "is_archived": true,
                "protection_status": "writer_perms_required",
                "auto_rebase": true,
                "sync_status": {
                    "last_attempt": {
                        "outcome": "succeeded",
                        "attempted_at": 1
                    }
                },
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "current_live_percentage": 1,
                "parent_branch_id": "test-value",
                "draft_exists": true,
                "draft_created_at": 1,
                "draft_is_behind_tip": true,
                "calls_7d": 1,
                "commits_ahead": 1,
                "commits_behind": 1,
                "merged_into_branch_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ListResponseAgentBranchSummary::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
