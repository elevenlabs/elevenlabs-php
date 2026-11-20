<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ModerationGuardrailInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "execution_mode": "streaming",
        "config": {
            "sexual": {
                "is_enabled": true,
                "threshold": 0
            },
            "violence": {
                "is_enabled": true,
                "threshold": 0
            },
            "violence_graphic": {
                "is_enabled": true,
                "threshold": 0
            },
            "harassment": {
                "is_enabled": true,
                "threshold": 0
            },
            "harassment_threatening": {
                "is_enabled": true,
                "threshold": 0
            },
            "hate": {
                "is_enabled": true,
                "threshold": 0
            },
            "hate_threatening": {
                "is_enabled": true,
                "threshold": 0
            },
            "self_harm_instructions": {
                "is_enabled": true,
                "threshold": 0
            },
            "self_harm": {
                "is_enabled": true,
                "threshold": 0
            },
            "self_harm_intent": {
                "is_enabled": true,
                "threshold": 0
            },
            "sexual_minors": {
                "is_enabled": true,
                "threshold": 0
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ModerationGuardrailInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
