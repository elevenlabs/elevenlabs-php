<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MergeProposalReviewTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_id": "test-value",
        "state": "approved",
        "submitted_at": 1,
        "comment": "test-value",
        "reviewer_role": "admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\MergeProposalReview::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
