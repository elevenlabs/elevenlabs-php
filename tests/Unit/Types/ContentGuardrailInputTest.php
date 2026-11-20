<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ContentGuardrailInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "execution_mode": "streaming",
        "config": {
            "sexual": {
                "is_enabled": true,
                "threshold": 1
            },
            "violence": {
                "is_enabled": true,
                "threshold": 1
            },
            "harassment": {
                "is_enabled": true,
                "threshold": 1
            },
            "self_harm": {
                "is_enabled": true,
                "threshold": 1
            },
            "profanity": {
                "is_enabled": true,
                "threshold": 1
            },
            "religion_or_politics": {
                "is_enabled": true,
                "threshold": 1
            },
            "medical_and_legal_information": {
                "is_enabled": true,
                "threshold": 1
            }
        },
        "trigger_action": {
            "type": "end_call"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ContentGuardrailInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
