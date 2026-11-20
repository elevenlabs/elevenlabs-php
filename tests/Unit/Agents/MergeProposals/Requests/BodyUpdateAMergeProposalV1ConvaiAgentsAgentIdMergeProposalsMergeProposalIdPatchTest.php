<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\MergeProposals\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatchTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value",
        "requested_reviewer_user_ids": [
            "test-value"
        ],
        "close": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\MergeProposals\Requests\BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
