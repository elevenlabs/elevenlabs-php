<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChapterContentBlockTtsNodeResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "tts_node",
        "project_voice_ref_id": "test-value",
        "text": "test-value",
        "voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ChapterContentBlockTtsNodeResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
