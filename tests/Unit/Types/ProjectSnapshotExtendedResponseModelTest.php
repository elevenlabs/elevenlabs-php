<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectSnapshotExtendedResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
        },
        "character_alignments": [
            {
                "characters": [
                    "test-value"
                ],
                "character_start_times_seconds": [
                    1
                ],
                "character_end_times_seconds": [
                    1
                ]
            }
        ],
        "audio_duration_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectSnapshotExtendedResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
