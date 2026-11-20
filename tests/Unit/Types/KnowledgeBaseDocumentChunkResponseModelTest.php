<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseDocumentChunkResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "content": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseDocumentChunkResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
