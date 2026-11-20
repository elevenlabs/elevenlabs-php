<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TranscriptionOrderItemRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "transcription",
        "media_ids": [
            "test-value"
        ],
        "source_language": "test-value",
        "verbatim": true,
        "instructions": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TranscriptionOrderItemRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
