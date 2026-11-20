<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RagConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "embedding_model": "e5_mistral_7b_instruct",
        "max_vector_distance": 1,
        "max_documents_length": 1,
        "max_retrieved_rag_chunks_count": 20,
        "num_candidates": 10000,
        "query_rewrite_prompt_override": "test-value",
        "knowledge_base_tool_info": {
            "enabled_strategies": [
                "cat"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\RagConfigInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
