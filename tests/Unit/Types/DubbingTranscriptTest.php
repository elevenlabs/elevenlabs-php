<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingTranscriptTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language": "test-value",
        "utterances": [
            {
                "text": "test-value",
                "speaker_id": "test-value",
                "start_s": 1,
                "end_s": 1,
                "words": [
                    {
                        "text": "test-value",
                        "word_type": "test-value",
                        "start_s": 1,
                        "end_s": 1,
                        "characters": [
                            {
                                "text": "test-value",
                                "start_s": 1,
                                "end_s": 1
                            }
                        ]
                    }
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingTranscript::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
