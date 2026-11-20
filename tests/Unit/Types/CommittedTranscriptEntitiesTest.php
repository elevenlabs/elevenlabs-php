<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CommittedTranscriptEntitiesTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "committed_transcript_entities",
        "text": "test-value",
        "entities": [
            {
                "text": "test-value",
                "entity_type": "test-value",
                "start_char": 1,
                "end_char": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\CommittedTranscriptEntities::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
