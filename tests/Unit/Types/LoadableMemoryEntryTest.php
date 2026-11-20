<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LoadableMemoryEntryTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "entry_id": "test-value",
        "summary": "test-value",
        "text": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\LoadableMemoryEntry::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
