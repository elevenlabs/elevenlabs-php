<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceAuditLogsPageResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "entries": [
            {
                "metadata": {
                    "key": "test-value"
                },
                "time": 1,
                "activity_id": 0,
                "activity_name": "test-value",
                "category_name": "test-value",
                "category_uid": 1,
                "class_name": "test-value",
                "class_uid": 1,
                "severity_id": 0,
                "status_id": 0,
                "actor": {
                    "user": {
                        "name": "test-value",
                        "uid": "test-value",
                        "type_id": 0,
                        "type": "test-value",
                        "email_addr": "test-value",
                        "full_name": "test-value",
                        "domain": "test-value"
                    },
                    "app_name": "test-value",
                    "app_uid": "test-value",
                    "session": {
                        "key": "test-value"
                    }
                },
                "device": {
                    "ip": "test-value",
                    "hostname": "test-value",
                    "type_id": 1
                },
                "http_request": {
                    "http_method": "test-value",
                    "url": {
                        "url_string": "test-value",
                        "scheme": "test-value",
                        "hostname": "test-value",
                        "port": 1,
                        "path": "test-value",
                        "query_string": "test-value"
                    },
                    "user_agent": "test-value",
                    "x_forwarded_for": [
                        "test-value"
                    ]
                },
                "message": "test-value",
                "unmapped": {
                    "key": "test-value"
                },
                "id": "test-value",
                "time_dt": "test-value",
                "type_uid": 1,
                "type_name": "test-value"
            }
        ],
        "has_more": true,
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceAuditLogsPageResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
