<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceAnalyticsQueryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "columns": [
            "test-value"
        ],
        "column_types": [
            "String"
        ],
        "rows": [
            [
                "test-value"
            ]
        ],
        "column_units": [
            "ms"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
