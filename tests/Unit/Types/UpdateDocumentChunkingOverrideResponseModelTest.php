<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpdateDocumentChunkingOverrideResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "chunking_override": {
            "max_chunk_size": 1,
            "overlap_percentage": 1,
            "custom_separators": [
                "test-value"
            ]
        },
        "reindex_queued": true
    }
    JSON;

    $instance = \ElevenLabs\Types\UpdateDocumentChunkingOverrideResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
