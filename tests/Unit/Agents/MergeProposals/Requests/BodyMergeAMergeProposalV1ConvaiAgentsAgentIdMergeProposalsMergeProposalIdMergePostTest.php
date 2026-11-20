<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\MergeProposals\Requests;

use PHPUnit\Framework\TestCase;

class BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePostTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "archive_source_branch": true,
        "force": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\MergeProposals\Requests\BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
