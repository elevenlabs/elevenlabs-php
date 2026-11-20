<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentKnowledgeBaseRagQueryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "strategy": "cat",
        "retrieval_query": "test-value",
        "chunks": [
            {
                "document_id": "test-value",
                "document_name": "test-value",
                "source_url": "test-value",
                "chunk_id": "test-value",
                "text": "test-value",
                "vector_distance": 1,
                "content_format": "html",
                "document_type": "file"
            }
        ],
        "document": {
            "document_id": "test-value",
            "document_name": "test-value",
            "source_url": "test-value",
            "content": "test-value",
            "truncated": true,
            "content_format": "html",
            "document_type": "file"
        },
        "listing": {
            "entries": [
                {
                    "id": "test-value",
                    "name": "test-value",
                    "is_folder": true
                }
            ],
            "total_count": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentKnowledgeBaseRagQueryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
