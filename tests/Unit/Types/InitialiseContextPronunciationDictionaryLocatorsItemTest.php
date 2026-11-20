<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InitialiseContextPronunciationDictionaryLocatorsItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "pronunciation_dictionary_id": "test-value",
        "version_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\InitialiseContextPronunciationDictionaryLocatorsItem::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
