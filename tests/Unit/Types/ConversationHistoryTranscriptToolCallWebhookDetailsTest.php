<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptToolCallWebhookDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
