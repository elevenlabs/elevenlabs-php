<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_initiation_metadata_event": {
            "conversation_id": "test-value",
            "agent_output_audio_format": "pcm_8000",
            "user_input_audio_format": "pcm_8000"
        },
        "type": "conversation_initiation_metadata"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationMetadata::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
