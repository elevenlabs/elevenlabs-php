<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceWebhookListResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhooks": [
            {
                "name": "test-value",
                "webhook_id": "test-value",
                "webhook_url": "test-value",
                "is_disabled": true,
                "is_auto_disabled": true,
                "created_at_unix": 1,
                "auth_type": "hmac",
                "usage": [
                    {
                        "usage_type": "ConvAI Agent Settings"
                    }
                ],
                "events": [
                    "voice_library_removal_notice"
                ],
                "most_recent_failure_error_code": 1,
                "most_recent_failure_timestamp": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceWebhookListResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
