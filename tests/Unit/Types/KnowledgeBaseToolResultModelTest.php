<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseToolResultModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "knowledge_base_success",
        "status": "success",
        "chunk_count": 1,
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseToolResultModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
