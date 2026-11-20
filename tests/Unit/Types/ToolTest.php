<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ToolTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\Tool::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
