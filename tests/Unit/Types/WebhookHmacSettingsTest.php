<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WebhookHmacSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\WebhookHmacSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
