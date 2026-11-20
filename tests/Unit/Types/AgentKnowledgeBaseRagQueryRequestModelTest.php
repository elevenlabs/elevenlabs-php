<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentKnowledgeBaseRagQueryRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "strategy": "cat",
        "query": "test-value",
        "documents": [
            "test-value"
        ],
        "use_agent_defaults": true,
        "max_documents_length": 50000,
        "max_retrieved_rag_chunks_count": 20
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentKnowledgeBaseRagQueryRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
