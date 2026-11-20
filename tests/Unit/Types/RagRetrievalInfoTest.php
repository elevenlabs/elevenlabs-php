<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RagRetrievalInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chunks": [
            {
                "document_id": "test-value",
                "chunk_id": "test-value",
                "vector_distance": 1
            }
        ],
        "embedding_model": "e5_mistral_7b_instruct",
        "retrieval_query": "test-value",
        "rag_latency_secs": 1,
        "used_chunk_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\RagRetrievalInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
