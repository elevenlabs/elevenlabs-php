<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSampleVisualWaveformResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sample_id": "test-value",
        "visual_waveform": [
            1
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSampleVisualWaveformResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
