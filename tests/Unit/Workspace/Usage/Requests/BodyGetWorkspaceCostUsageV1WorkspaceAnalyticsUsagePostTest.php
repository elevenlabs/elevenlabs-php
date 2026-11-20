<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Usage\Requests;

use PHPUnit\Framework\TestCase;

class BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1577836800000,
        "end_time": 1577836800000,
        "interval_seconds": 86400,
        "group_by": [
            "model"
        ],
        "filters": [
            {
                "column": "model",
                "operation": "eq",
                "values": [
                    "test-value"
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
