<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Requests;

use PHPUnit\Framework\TestCase;

class BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "items": [
            {
                "document_id": "test-value",
                "create_if_missing": true,
                "model": "e5_mistral_7b_instruct"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Requests\BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
