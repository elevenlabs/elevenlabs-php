<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectVideoThumbnailSheetResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_thumbnail_index": 1,
        "thumbnail_count": 1,
        "signed_cloud_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectVideoThumbnailSheetResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
