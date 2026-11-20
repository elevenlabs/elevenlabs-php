<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model_id": "test-value",
        "name": "test-value",
        "can_be_finetuned": true,
        "can_do_text_to_speech": true,
        "can_do_voice_conversion": true,
        "can_use_style": true,
        "can_use_speaker_boost": true,
        "serves_pro_voices": true,
        "token_cost_factor": 1,
        "description": "test-value",
        "requires_alpha_access": true,
        "max_characters_request_free_user": 1,
        "max_characters_request_subscribed_user": 1,
        "maximum_text_length_per_request": 1,
        "languages": [
            {
                "language_id": "test-value",
                "name": "test-value"
            }
        ],
        "model_rates": {
            "character_cost_multiplier": 1,
            "cost_discount_multiplier": 1
        },
        "concurrency_group": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\Model::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
