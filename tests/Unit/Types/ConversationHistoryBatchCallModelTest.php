<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryBatchCallModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "batch_call_id": "test-value",
        "batch_call_recipient_id": "test-value",
        "campaign": {
            "campaign_id": "test-value",
            "campaign_lead_id": "test-value",
            "cold_attempt": 1,
            "conversation_type": "initial"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryBatchCallModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
