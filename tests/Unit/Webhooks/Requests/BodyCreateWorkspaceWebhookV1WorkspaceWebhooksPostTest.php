<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Webhooks\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "settings": {
            "auth_type": "hmac",
            "name": "test-value",
            "webhook_url": "test-value",
            "request_headers": {
                "key": "test-value"
            },
            "log_redacted_fields": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Webhooks\Requests\BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
