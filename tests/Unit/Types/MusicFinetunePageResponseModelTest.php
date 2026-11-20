<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MusicFinetunePageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "finetunes": [
            {
                "id": "test-value",
                "name": "test-value",
                "tags": [
                    "test-value"
                ],
                "primary_genre": "test-value",
                "model_id": "test-value",
                "created_at": "2023-01-01T12:34:56Z",
                "visibility": "private",
                "created_by": "self",
                "status": "pending",
                "training_progress": 1,
                "failure_reason": "audio_processing_failed"
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\MusicFinetunePageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
