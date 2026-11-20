<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Chapters\Snapshots\Requests;

use PHPUnit\Framework\TestCase;

class BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "convert_to_mpeg": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Chapters\Snapshots\Requests\BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
