<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DependentBranchInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "agent_name": "test-value",
        "branch_id": "test-value",
        "branch_name": "test-value",
        "is_main": true
    }
    JSON;

    $instance = \ElevenLabs\Types\DependentBranchInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
