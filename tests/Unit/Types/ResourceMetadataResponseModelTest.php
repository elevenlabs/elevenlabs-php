<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResourceMetadataResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "resource_id": "test-value",
        "resource_name": "test-value",
        "resource_type": "voice",
        "creator_user_id": "test-value",
        "anonymous_access_level_override": "admin",
        "role_to_group_ids": {
            "key": [
                "test-value"
            ]
        },
        "share_options": [
            {
                "name": "test-value",
                "id": "test-value",
                "type": "user"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ResourceMetadataResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
