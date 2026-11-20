<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Webhooks\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_disabled": true,
        "name": "test-value",
        "retry_enabled": true,
        "request_headers": {
            "key": "test-value"
        },
        "events": [
            "voice_library_removal_notice"
        ],
        "log_redacted_fields": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Webhooks\Requests\BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
