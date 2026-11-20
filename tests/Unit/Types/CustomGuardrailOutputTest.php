<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CustomGuardrailOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "config": {
            "configs": [
                {
                    "is_enabled": true,
                    "name": "test-value",
                    "prompt": "test-value",
                    "execution_mode": "streaming",
                    "model": "gemini-2.5-flash-lite",
                    "service_tier": "standard",
                    "history_message_count": 0,
                    "trigger_action": {
                        "type": "end_call"
                    },
                    "evaluate_full_response_only": true
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CustomGuardrailOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
