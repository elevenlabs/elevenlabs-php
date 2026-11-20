<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ChunkingOverrideRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "max_chunk_size": 200,
        "overlap_percentage": 0,
        "custom_separators": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ChunkingOverrideRequestModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
