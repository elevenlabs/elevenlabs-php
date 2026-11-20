<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetDocumentChunkingOverrideResponseModelTest extends TestCase
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
        "effective_chunking_override": {
            "max_chunk_size": 1,
            "overlap_percentage": 1,
            "custom_separators": [
                "test-value"
            ]
        },
        "inherited_chunking_override": {
            "max_chunk_size": 1,
            "overlap_percentage": 1,
            "custom_separators": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GetDocumentChunkingOverrideResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
