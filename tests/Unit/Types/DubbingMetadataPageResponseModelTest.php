<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingMetadataPageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "dubs": [
            {
                "dubbing_id": "test-value",
                "name": "test-value",
                "status": "test-value",
                "source_language": "test-value",
                "target_languages": [
                    "test-value"
                ],
                "editable": true,
                "created_at": "2023-01-01T12:34:56Z",
                "media_metadata": {
                    "content_type": "test-value",
                    "duration": 1
                },
                "error": "test-value"
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingMetadataPageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
