<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptFileInputResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "file_id": "test-value",
        "original_filename": "test-value",
        "mime_type": "test-value",
        "file_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptFileInputResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
