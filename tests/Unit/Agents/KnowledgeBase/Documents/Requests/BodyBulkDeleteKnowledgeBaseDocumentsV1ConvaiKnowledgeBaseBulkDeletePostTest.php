<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "document_ids": [
            "test-value"
        ],
        "force": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
