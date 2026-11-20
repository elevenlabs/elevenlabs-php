<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "move_to": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
