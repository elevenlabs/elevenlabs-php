<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingTranscriptWordTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "word_type": "test-value",
        "start_s": 1,
        "end_s": 1,
        "characters": [
            {
                "text": "test-value",
                "start_s": 1,
                "end_s": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingTranscriptWord::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
