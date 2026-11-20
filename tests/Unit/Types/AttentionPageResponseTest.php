<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AttentionPageResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "attention": [
            {
                "attention_id": "test-value",
                "campaign_id": "test-value",
                "reason": "test-value",
                "detail": "test-value",
                "status": "open",
                "retryable": true,
                "resolution": "test-value",
                "created_at_unix": 1,
                "updated_at_unix": 1
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\AttentionPageResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
