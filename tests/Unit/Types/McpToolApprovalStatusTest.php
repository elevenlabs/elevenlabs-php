<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolApprovalStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_id": "test-value",
        "state": "up_to_date",
        "approval_policy": "auto_approved",
        "approved_definition": {
            "description": "test-value",
            "input_schema": {
                "key": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolApprovalStatus::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
