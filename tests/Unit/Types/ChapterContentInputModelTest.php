<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChapterContentInputModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "blocks": [
            {
                "sub_type": "p",
                "nodes": [
                    {
                        "type": "tts_node",
                        "text": "test-value",
                        "voice_id": "test-value"
                    }
                ],
                "block_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ChapterContentInputModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
