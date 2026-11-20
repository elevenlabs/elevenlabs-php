<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioEffectsEnvironmentResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "environment_id": "test-value",
        "name": "test-value",
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioEffectsEnvironmentResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
