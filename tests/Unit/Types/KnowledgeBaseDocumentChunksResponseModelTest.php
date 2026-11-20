<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseDocumentChunksResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chunks": [
            {
                "id": "test-value",
                "name": "test-value",
                "content": "test-value"
            }
        ],
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseDocumentChunksResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
