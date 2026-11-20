<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptToolCallCommonModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "system",
        "request_id": "test-value",
        "tool_name": "test-value",
        "tool_id": "test-value",
        "params_as_json": "test-value",
        "tool_has_been_called": true,
        "tool_details": {
            "type": "webhook",
            "method": "test-value",
            "url": "test-value",
            "headers": {
                "key": "test-value"
            },
            "path_params": {
                "key": "test-value"
            },
            "query_params": {
                "key": "test-value"
            },
            "body": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
