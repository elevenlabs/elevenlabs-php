<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PrivateKeyJwtResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "private_key_jwt",
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

    $instance = \ElevenLabs\Types\PrivateKeyJwtResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
