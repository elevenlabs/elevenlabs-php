<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\TriageTickets\Requests;

use PHPUnit\Framework\TestCase;

class MergeAgentConversationTicketsRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_ticket_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Agents\TriageTickets\Requests\MergeAgentConversationTicketsRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
