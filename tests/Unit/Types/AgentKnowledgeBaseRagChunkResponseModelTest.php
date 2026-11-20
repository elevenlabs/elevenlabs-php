<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentKnowledgeBaseRagChunkResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\AgentKnowledgeBaseRagChunkResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
