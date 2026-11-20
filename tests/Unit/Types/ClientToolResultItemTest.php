<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientToolResultItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "client_tool_result",
        "tool_call_id": "test-value",
        "result": "test-value",
        "is_error": true,
        "error_type": "user_rejected"
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientToolResultItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
