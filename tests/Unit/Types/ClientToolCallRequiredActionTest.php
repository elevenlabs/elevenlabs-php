<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientToolCallRequiredActionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "client_tool_call",
        "tool_call_id": "test-value",
        "tool_name": "test-value",
        "parameters": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientToolCallRequiredAction::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
