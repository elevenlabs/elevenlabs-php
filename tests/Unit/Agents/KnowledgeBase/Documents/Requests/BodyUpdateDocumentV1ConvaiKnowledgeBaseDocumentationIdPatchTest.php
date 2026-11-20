<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "content": "test-value",
        "enable_auto_sync": true,
        "auto_remove": true,
        "minimum_frequency_days": 1,
        "tighten_only": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
