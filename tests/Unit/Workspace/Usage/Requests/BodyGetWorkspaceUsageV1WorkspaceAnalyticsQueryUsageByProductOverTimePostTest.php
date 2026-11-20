<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Usage\Requests;

use PHPUnit\Framework\TestCase;

class BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1577836800000,
        "end_time": 1577836800000,
        "interval_seconds": 1,
        "group_by": [
            "product_type"
        ],
        "filters": [
            {
                "column": "test-value",
                "operation": "in",
                "values": [
                    "test-value"
                ]
            }
        ],
        "time_zone": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
