<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EnvironmentVariablesListResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "environment_variables": [
            {
                "label": "test-value",
                "created_at_unix_secs": 1,
                "updated_at_unix_secs": 1,
                "created_by_user_id": "test-value",
                "type": "string",
                "id": "test-value",
                "workspace_id": "test-value",
                "values": {
                    "key": "test-value"
                }
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\EnvironmentVariablesListResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
