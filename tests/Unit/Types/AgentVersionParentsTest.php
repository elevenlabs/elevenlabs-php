<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentVersionParentsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "in_branch_parent_id": "test-value",
        "out_of_branch_parent_id": "test-value",
        "merged_into_branch_id": "test-value",
        "merged_from_branch_id": "test-value",
        "merged_from_version_id": "test-value",
        "rebased_from_version_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentVersionParents::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
