<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TicketMergeProposalLinkResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "merge_proposal_id": "test-value",
        "linked_by_user_id": "test-value",
        "linked_at_unix_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TicketMergeProposalLinkResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
