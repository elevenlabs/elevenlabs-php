<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetConversationSummaryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "agent_id": "test-value",
        "status": "initiated",
        "call_summary_title": "test-value",
        "transcript_summary": "test-value",
        "call_successful": "success",
        "message_count": 1,
        "messages": [
            {
                "role": "user",
                "message": "test-value"
            }
        ],
        "messages_omitted": true,
        "note": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetConversationSummaryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
