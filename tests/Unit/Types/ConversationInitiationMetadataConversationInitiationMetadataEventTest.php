<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationMetadataConversationInitiationMetadataEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "agent_output_audio_format": "pcm_8000",
        "user_input_audio_format": "pcm_8000"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
