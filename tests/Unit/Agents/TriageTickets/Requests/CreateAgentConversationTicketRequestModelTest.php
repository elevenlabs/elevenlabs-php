<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\TriageTickets\Requests;

use PHPUnit\Framework\TestCase;

class CreateAgentConversationTicketRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "title": "test-value",
        "qa_comment": "test-value",
        "turn_comments": [
            {
                "turn_index": 0,
                "comment": "test-value"
            }
        ],
        "priority": "low"
    }
    JSON;

    $instance = \ElevenLabs\Agents\TriageTickets\Requests\CreateAgentConversationTicketRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
