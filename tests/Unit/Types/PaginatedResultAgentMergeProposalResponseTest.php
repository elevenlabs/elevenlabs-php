<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PaginatedResultAgentMergeProposalResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "results": [
            {
                "id": "test-value",
                "agent_id": "test-value",
                "source_branch_id": "test-value",
                "target_branch_id": "test-value",
                "source_tip_version_id_at_creation": "test-value",
                "title": "test-value",
                "description": "test-value",
                "requested_reviewer_user_ids": [
                    "test-value"
                ],
                "reviews": [
                    {
                        "user_id": "test-value",
                        "state": "approved",
                        "submitted_at": 1,
                        "comment": "test-value",
                        "reviewer_role": "admin"
                    }
                ],
                "comments": [
                    {
                        "id": "test-value",
                        "user_id": "test-value",
                        "body": "test-value",
                        "created_at": 1
                    }
                ],
                "outcome": {
                    "status": "open"
                },
                "created_at": 1,
                "updated_at": 1,
                "author_user_id": "test-value",
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                }
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\PaginatedResultAgentMergeProposalResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
