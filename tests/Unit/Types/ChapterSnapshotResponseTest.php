<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChapterSnapshotResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chapter_snapshot_id": "test-value",
        "project_id": "test-value",
        "chapter_id": "test-value",
        "created_at_unix": 1,
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ChapterSnapshotResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
