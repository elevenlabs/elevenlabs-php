<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BasicAuthResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "basic_auth",
        "provider": "test-value",
        "username": "test-value",
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

    $instance = \ElevenLabs\Types\BasicAuthResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
