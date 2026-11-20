<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MessagesSearchResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "meta": {
            "total": 1,
            "page": 1,
            "page_size": 1
        },
        "results": [
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
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\MessagesSearchResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
