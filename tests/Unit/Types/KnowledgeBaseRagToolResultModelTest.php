<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseRagToolResultModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "knowledge_base_rag_success",
        "status": "success",
        "chunk_count": 1,
        "message": "test-value",
        "chunks": [
            {
                "chunk_id": "test-value",
                "document_id": "test-value",
                "content": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseRagToolResultModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
