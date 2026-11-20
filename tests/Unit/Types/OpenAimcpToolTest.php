<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAimcpToolTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "mcp",
        "server_label": "test-value",
        "server_url": "test-value",
        "authorization": "test-value",
        "allowed_tools": [
            "test-value"
        ],
        "require_approval": "never"
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAimcpTool::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
