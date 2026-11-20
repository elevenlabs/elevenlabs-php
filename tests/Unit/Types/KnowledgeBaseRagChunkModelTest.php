<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseRagChunkModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chunk_id": "test-value",
        "document_id": "test-value",
        "content": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseRagChunkModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
