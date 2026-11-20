<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChapterSnapshotExtendedResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chapter_snapshot_id": "test-value",
        "project_id": "test-value",
        "chapter_id": "test-value",
        "created_at_unix": 1,
        "name": "test-value",
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
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ChapterSnapshotExtendedResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
