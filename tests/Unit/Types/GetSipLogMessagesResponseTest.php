<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetSipLogMessagesResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sip_messages": [
            {
                "call_id": "test-value",
                "phone_numbers": [
                    "test-value"
                ],
                "local_address": "test-value",
                "remote_address": "test-value",
                "transport": "test-value",
                "raw_message": "test-value",
                "error_message": "test-value",
                "direction": "in",
                "created_at_unix_micro": 1
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetSipLogMessagesResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
