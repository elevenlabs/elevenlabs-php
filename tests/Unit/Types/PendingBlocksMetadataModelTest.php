<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PendingBlocksMetadataModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "target_global_offset_ms": 1,
        "block_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\PendingBlocksMetadataModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
