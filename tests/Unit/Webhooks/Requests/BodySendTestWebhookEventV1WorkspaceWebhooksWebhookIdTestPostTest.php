<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Webhooks\Requests;

use PHPUnit\Framework\TestCase;

class BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook_type": "project_conversion_status"
    }
    JSON;

    $instance = \ElevenLabs\Webhooks\Requests\BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
