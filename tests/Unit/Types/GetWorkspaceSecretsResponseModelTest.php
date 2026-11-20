<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetWorkspaceSecretsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "secrets": [
            {
                "type": "stored",
                "secret_id": "test-value",
                "name": "test-value",
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
                    "tools_has_more": true,
                    "agents": [
                        {
                            "referenced_resource_ids": [
                                "test-value"
                            ],
                            "id": "test-value",
                            "name": "test-value",
                            "type": "available",
                            "created_at_unix_secs": 1,
                            "access_level": "admin"
                        }
                    ],
                    "agents_has_more": true,
                    "phone_numbers": [
                        {
                            "phone_number_id": "test-value",
                            "phone_number": "test-value",
                            "label": "test-value",
                            "provider": "twilio"
                        }
                    ],
                    "phone_numbers_has_more": true,
                    "mcp_servers": [
                        {
                            "id": "test-value",
                            "name": "test-value",
                            "type": "available",
                            "created_at_unix_secs": 1,
                            "access_level": "admin"
                        }
                    ],
                    "others": [
                        "conversation_initiation_webhook"
                    ]
                }
            }
        ],
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetWorkspaceSecretsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
