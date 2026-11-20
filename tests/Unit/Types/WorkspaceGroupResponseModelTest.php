<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceGroupResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "id": "test-value",
        "members": [
            "test-value"
        ],
        "permissions": [
            "text_to_speech"
        ],
        "group_usage_limit": 1,
        "group_pvc_limit": 1,
        "group_concurrency_limit": 1,
        "group_dubbing_concurrency_limit": 1,
        "group_music_concurrency_limit": 1,
        "character_count": 1,
        "is_scim_synced": true,
        "scim_group": {
            "scim_external_id": "test-value",
            "display_name": "test-value",
            "created_at_unix": 1,
            "updated_at_unix": 1,
            "seat_type": "workspace_admin"
        },
        "scim_frozen": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceGroupResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
