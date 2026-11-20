<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ApiIntegrationOAuth2AuthCodeResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "api_integration_oauth2_auth_code",
        "provider": "test-value",
        "token_url": "test-value",
        "scopes": [
            "test-value"
        ],
        "scope_separator": " ",
        "expires_at": "test-value",
        "integration_id": "test-value",
        "credential_id": "test-value",
        "id": "test-value",
        "used_by": {
            "tools": [
                {
                    "id": "test-value",
                    "name": "test-value",
                    "type": "available",
                    "created_at_unix_secs": 1,
                    "access_level": "admin"
                }
            ],
            "mcp_servers": [
                {
                    "id": "test-value",
                    "name": "test-value",
                    "type": "available",
                    "created_at_unix_secs": 1,
                    "access_level": "admin"
                }
            ],
            "integration_connections": [
                {
                    "id": "test-value",
                    "name": "test-value"
                }
            ]
        },
        "status": "active",
        "status_detail": "test-value",
        "status_updated_at": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
