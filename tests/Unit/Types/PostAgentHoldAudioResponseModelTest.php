<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PostAgentHoldAudioResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "hold_audio": {
            "audio_path": "test-value",
            "audio_url": "test-value",
            "original_filename": "test-value",
            "duration_secs": 1,
            "size_bytes": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PostAgentHoldAudioResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
