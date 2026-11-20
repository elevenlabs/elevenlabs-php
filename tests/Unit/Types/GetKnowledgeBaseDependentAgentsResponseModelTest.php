<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetKnowledgeBaseDependentAgentsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agents": [
            {
                "referenced_resource_ids": [
                    "test-value"
                ],
                "id": "test-value",
                "name": "test-value",
                "type": "available",
                "created_at_unix_secs": 1,
                "access_level": "admin"
            }
        ],
        "branches": [
            {
                "agent_id": "test-value",
                "agent_name": "test-value",
                "branch_id": "test-value",
                "branch_name": "test-value",
                "is_main": true
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
