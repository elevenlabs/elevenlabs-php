<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceStatisticsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "project_voice_ref_id": "test-value",
        "characters_unconverted": 1,
        "characters_converted": 1,
        "credits_needed_to_convert": 1,
        "voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceStatisticsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
