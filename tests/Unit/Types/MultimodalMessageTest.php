<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MultimodalMessageTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "multimodal_message",
        "text": {
            "id": "test-value",
            "type": "user_message",
            "text": "test-value",
            "user_identifier": "test-value",
            "source_medium": "audio"
        },
        "file": {
            "type": "file_input",
            "file_id": "test-value"
        },
        "files": [
            {
                "type": "file_input",
                "file_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\MultimodalMessage::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
