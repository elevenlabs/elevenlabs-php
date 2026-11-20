<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpdateOAuth2ClientCredsRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "auth_type": "oauth2_client_credentials",
        "provider": "test-value",
        "client_id": "test-value",
        "scopes": [
            "test-value"
        ],
        "extra_params": {
            "key": "test-value"
        },
        "basic_auth_in_header": true,
        "client_secret": "test-value",
        "custom_headers": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
