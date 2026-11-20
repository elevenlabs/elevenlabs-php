<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\TriageTickets\Requests;

use PHPUnit\Framework\TestCase;

class PatchAgentConversationTicketRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "qa_comment": "test-value",
        "status": "open",
        "assignee_user_id": "test-value",
        "priority": "low"
    }
    JSON;

    $instance = \ElevenLabs\Agents\TriageTickets\Requests\PatchAgentConversationTicketRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
