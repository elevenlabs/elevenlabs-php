<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestRunResultSummaryTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "test_id": "test-value",
        "test_name": "test-value",
        "workflow_node_id": "test-value",
        "buckets": [
            {
                "test_run_ids": [
                    "test-value"
                ],
                "title": "test-value",
                "reason": "test-value",
                "status": "pending"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\TestRunResultSummary::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
