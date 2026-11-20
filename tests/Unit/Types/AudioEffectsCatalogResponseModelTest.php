<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioEffectsCatalogResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "filter_presets": [
            {
                "filter_preset_id": "test-value",
                "name": "test-value",
                "description": "test-value"
            }
        ],
        "environments": [
            {
                "environment_id": "test-value",
                "name": "test-value",
                "description": "test-value"
            }
        ],
        "background_noises": [
            {
                "background_noise_id": "test-value",
                "name": "test-value",
                "description": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioEffectsCatalogResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
