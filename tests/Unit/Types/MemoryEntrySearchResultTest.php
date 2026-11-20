<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MemoryEntrySearchResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "entry_id": "test-value",
        "version": 1,
        "summary": "test-value",
        "text": "test-value",
        "source": {
            "type": "conversation",
            "conversation_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\MemoryEntrySearchResult::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
