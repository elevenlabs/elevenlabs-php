<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DiarizedTranscriptWordsItemCharactersItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "start": 1,
        "end": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DiarizedTranscriptWordsItemCharactersItem::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
