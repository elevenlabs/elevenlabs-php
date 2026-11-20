<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Snapshots\Requests;

use PHPUnit\Framework\TestCase;

class BodyStreamStudioProjectAudioV1StudioProjectsProjectIdSnapshotsProjectSnapshotIdStreamPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "convert_to_mpeg": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Snapshots\Requests\BodyStreamStudioProjectAudioV1StudioProjectsProjectIdSnapshotsProjectSnapshotIdStreamPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
