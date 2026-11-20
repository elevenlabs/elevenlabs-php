<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\MergeProposals\Requests;

use PHPUnit\Framework\TestCase;

class BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "state": "approved",
        "comment": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\MergeProposals\Requests\BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
