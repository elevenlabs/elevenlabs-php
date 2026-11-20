<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Analytics\Requests\Requests;

use PHPUnit\Framework\TestCase;

class BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1577836800000,
        "end_time": 1577836800000,
        "limit": 1,
        "sort": "asc",
        "filters": [
            {
                "column": "test-value",
                "operation": "in",
                "values": [
                    "test-value"
                ]
            }
        ],
        "search": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Analytics\Requests\Requests\BodyListApiRequestsV1WorkspaceAnalyticsRequestsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
