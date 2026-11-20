<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MessagesSearchResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "agent_id": "test-value",
        "agent_name": "test-value",
        "transcript_index": 1,
        "chunk_text": "test-value",
        "chunk_highlights": [
            {
                "value": "test-value",
                "is_hit": true
            }
        ],
        "score": 1,
        "conversation_start_time_unix_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\MessagesSearchResult::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
