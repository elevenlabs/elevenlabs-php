<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChapterContentParagraphTtsNodeInputModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "tts_node",
        "text": "test-value",
        "voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
