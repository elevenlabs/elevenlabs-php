<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\MergeProposals\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_branch_id": "test-value",
        "target_branch_id": "test-value",
        "title": "test-value",
        "description": "test-value",
        "requested_reviewer_user_ids": [
            "test-value"
        ],
        "triage_ticket_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\MergeProposals\Requests\BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
