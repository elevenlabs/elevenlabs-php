<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetTestInvocationsPageResponseModelTest extends TestCase
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
                "branch_id": "test-value",
                "version_id": "test-value",
                "ran_against_draft": true,
                "runs_diverged_from_version": true,
                "created_at_unix_secs": 1,
                "test_run_count": 1,
                "passed_count": 1,
                "failed_count": 1,
                "pending_count": 1,
                "cancelled_count": 1,
                "title": "test-value",
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "repeat_count": 1,
                "cancelled": true,
                "credits_used": 1,
                "total_price": 1
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetTestInvocationsPageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
