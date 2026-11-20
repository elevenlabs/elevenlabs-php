<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CharacterAlignmentResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "characters": [
            "test-value"
        ],
        "character_start_times_seconds": [
            1
        ],
        "character_end_times_seconds": [
            1
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\CharacterAlignmentResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
