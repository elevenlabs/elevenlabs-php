<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RagChunkMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "document_id": "test-value",
        "chunk_id": "test-value",
        "vector_distance": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\RagChunkMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
