<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReadMetadataChapterDbModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chapter_name": "test-value",
        "word_count": 1,
        "char_count": 1,
        "starting_char_offset": 1,
        "has_parsed_html": true,
        "has_summary": true,
        "duration_seconds": 1,
        "file_number": "test-value",
        "is_fallback_name": true,
        "chapter_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReadMetadataChapterDbModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
