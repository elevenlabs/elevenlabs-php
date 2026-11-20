<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferBranchInfoTrafficSplitTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "branch_reason": "traffic_split",
        "branch_id": "test-value",
        "traffic_percentage": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferBranchInfoTrafficSplit::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
