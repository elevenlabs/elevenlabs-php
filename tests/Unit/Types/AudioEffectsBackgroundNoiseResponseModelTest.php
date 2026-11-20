<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioEffectsBackgroundNoiseResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "background_noise_id": "test-value",
        "name": "test-value",
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioEffectsBackgroundNoiseResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
