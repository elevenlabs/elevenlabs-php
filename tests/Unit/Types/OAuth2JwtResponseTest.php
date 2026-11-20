<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OAuth2JwtResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "oauth2_jwt",
        "provider": "test-value",
        "algorithm": "HS256",
        "key_id": "test-value",
        "issuer": "test-value",
        "audience": "test-value",
        "subject": "test-value",
        "expiration_seconds": 60,
        "extra_params": {
            "key": "test-value"
        },
        "extra_headers": {
            "key": "test-value"
        },
        "token_url": "test-value",
        "scopes": [
            "test-value"
        ],
        "token_response_field": "access_token",
        "jwt_usage": "authorization_grant",
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

    $instance = \ElevenLabs\Types\OAuth2JwtResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
