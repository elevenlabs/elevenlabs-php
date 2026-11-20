<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TextToDialogueMultiClientMessageTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "inputs": [
            {
                "text": "test-value",
                "voice_id": "test-value",
                "new_turn": true
            }
        ],
        "flush": true,
        "close_socket": true,
        "keep_alive": true,
        "xi_api_key": "test-value",
        "authorization": "test-value",
        "single_use_token": "test-value",
        "voices": [
            "test-value"
        ],
        "voice_settings": {
            "stability": 0
        },
        "pronunciation_dictionary_locators": [
            {
                "pronunciation_dictionary_id": "test-value",
                "version_id": "test-value"
            }
        ],
        "context_id": "test-value",
        "close_context": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TextToDialogueMultiClientMessage::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
