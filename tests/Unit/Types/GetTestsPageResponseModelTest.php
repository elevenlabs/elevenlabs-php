<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetTestsPageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tests": [
            {
                "id": "test-value",
                "name": "test-value",
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "created_at_unix_secs": 1,
                "last_updated_at_unix_secs": 1,
                "type": "llm",
                "entity_type": "test",
                "folder_parent_id": "test-value",
                "folder_path": [
                    {
                        "id": "test-value",
                        "name": "test-value"
                    }
                ],
                "children_count": 1,
                "conversation_initiation_source": "unknown"
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetTestsPageResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
