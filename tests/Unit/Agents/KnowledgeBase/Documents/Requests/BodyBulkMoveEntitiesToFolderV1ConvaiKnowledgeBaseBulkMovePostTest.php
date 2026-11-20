<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "document_ids": [
            "test-value"
        ],
        "move_to": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
