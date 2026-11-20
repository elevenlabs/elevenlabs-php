<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CharacterMetadataResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "description": "test-value",
        "sample_message": "test-value",
        "voice_creation_prompt_suggestion": "test-value",
        "gender": "male",
        "age": "young",
        "accent": "test-value",
        "role": "narrator"
    }
    JSON;

    $instance = \ElevenLabs\Types\CharacterMetadataResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
