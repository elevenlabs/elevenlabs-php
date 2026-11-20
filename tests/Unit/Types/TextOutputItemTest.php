<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TextOutputItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "text",
        "role": "agent",
        "id": "test-value",
        "text": "test-value",
        "created_at_unix_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TextOutputItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
