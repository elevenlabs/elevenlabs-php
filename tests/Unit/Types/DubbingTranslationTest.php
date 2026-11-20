<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingTranslationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "translation",
        "text": "test-value",
        "segment_id": "test-value",
        "start_s": 0,
        "end_s": 0,
        "speaker_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingTranslation::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
