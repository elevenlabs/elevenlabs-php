<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PhoneNumberAgentInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "agent_name": "test-value",
        "environment": "test-value",
        "branch_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PhoneNumberAgentInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
