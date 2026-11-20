<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CharacterResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "character_id": "test-value",
        "name": "test-value",
        "metadata": {
            "description": "test-value",
            "sample_message": "test-value",
            "voice_creation_prompt_suggestion": "test-value",
            "gender": "male",
            "age": "young",
            "accent": "test-value",
            "role": "narrator"
        },
        "recommended_voice_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\CharacterResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
