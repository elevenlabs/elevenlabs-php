<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectSnapshotsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "snapshots": [
            {
                "project_snapshot_id": "test-value",
                "project_id": "test-value",
                "created_at_unix": 1,
                "name": "test-value",
                "audio_upload": {
                    "key": "test-value"
                },
                "zip_upload": {
                    "key": "test-value"
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectSnapshotsResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
