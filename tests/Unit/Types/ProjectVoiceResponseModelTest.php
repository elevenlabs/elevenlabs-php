<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProjectVoiceResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "project_voice_ref_id": "test-value",
        "voice_id": "test-value",
        "alias": "test-value",
        "stability": 1,
        "similarity_boost": 1,
        "style": 1,
        "is_pinned": true,
        "use_speaker_boost": true,
        "volume_gain": 1,
        "speed": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ProjectVoiceResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
