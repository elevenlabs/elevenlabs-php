<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationConfigWorkflowOverrideInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text_only": true,
        "max_duration_seconds": 1,
        "client_events": [
            "conversation_initiation_metadata"
        ],
        "file_input": {
            "enabled": true,
            "max_files_in_memory": 1,
            "max_files_per_conversation": 1
        },
        "monitoring_enabled": true,
        "monitoring_events": [
            "conversation_initiation_metadata"
        ],
        "dtmf_input_settings": {
            "dtmf_input_timeout": 0.5,
            "hash_terminator": true,
            "redact_input": true
        },
        "background_sound": {
            "source_type": "preset",
            "source_id": "office2",
            "volume": 1,
            "crossfade_loop": true
        },
        "source_attribution": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationConfigWorkflowOverrideInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
