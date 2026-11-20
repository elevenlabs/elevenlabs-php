<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceApiKeyResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "hint": "test-value",
        "key_id": "test-value",
        "service_account_user_id": "test-value",
        "created_at_unix": 1,
        "is_disabled": true,
        "permissions": [
            "text_to_speech"
        ],
        "disable_reason": "trial_ended",
        "character_limit": 1,
        "character_count": 1,
        "hashed_xi_api_key": "test-value",
        "allowed_ips": [
            "test-value"
        ],
        "third_party_disable_allowed": true,
        "platform_limits": {
            "credits": {
                "limit": 1,
                "usage": 1
            },
            "pvc": {
                "limit": 1
            },
            "concurrency": {
                "limit": 1
            },
            "dubbing_concurrency": {
                "limit": 1
            },
            "music_concurrency": {
                "limit": 1
            }
        },
        "expires_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceApiKeyResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
