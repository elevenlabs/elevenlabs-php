<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioEffectsFilterPresetResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "filter_preset_id": "test-value",
        "name": "test-value",
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioEffectsFilterPresetResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
