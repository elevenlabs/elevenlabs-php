<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MediaGenerationListResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "generations": [
            {
                "id": "test-value",
                "status": "pending"
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\MediaGenerationListResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
