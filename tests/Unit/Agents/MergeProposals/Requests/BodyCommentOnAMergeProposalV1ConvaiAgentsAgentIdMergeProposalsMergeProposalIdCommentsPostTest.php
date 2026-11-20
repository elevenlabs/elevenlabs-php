<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\MergeProposals\Requests;

use PHPUnit\Framework\TestCase;

class BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "body": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\MergeProposals\Requests\BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
