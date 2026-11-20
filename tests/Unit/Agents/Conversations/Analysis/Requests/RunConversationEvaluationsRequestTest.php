<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Analysis\Requests;

use PHPUnit\Framework\TestCase;

class RunConversationEvaluationsRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "evaluation_id": "test-value",
        "scope": "conversation",
        "evaluated_agent_id": "test-value",
        "evaluated_branch_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Conversations\Analysis\Requests\RunConversationEvaluationsRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
