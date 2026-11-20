<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListMcpToolsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "success": true,
        "tools": [
            {
                "name": "test-value",
                "title": "test-value",
                "description": "test-value",
                "inputSchema": {
                    "key": "test-value"
                },
                "execution": {
                    "taskSupport": "forbidden"
                },
                "outputSchema": {
                    "key": "test-value"
                },
                "icons": [
                    {
                        "src": "test-value",
                        "mimeType": "test-value",
                        "sizes": [
                            "test-value"
                        ],
                        "theme": "light"
                    }
                ],
                "annotations": {
                    "title": "test-value",
                    "readOnlyHint": true,
                    "destructiveHint": true,
                    "idempotentHint": true,
                    "openWorldHint": true
                },
                "_meta": {
                    "key": "test-value"
                }
            }
        ],
        "tool_approval_statuses": [
            {
                "tool_id": "test-value",
                "state": "up_to_date",
                "approval_policy": "auto_approved",
                "approved_definition": {
                    "description": "test-value",
                    "input_schema": {
                        "key": "test-value"
                    }
                }
            }
        ],
        "error_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ListMcpToolsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
