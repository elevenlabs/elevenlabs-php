<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UserTranscriptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "user_transcript",
        "event_id": 1,
        "user_transcript": [
            {
                "role": "test-value",
                "content": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\UserTranscript::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
