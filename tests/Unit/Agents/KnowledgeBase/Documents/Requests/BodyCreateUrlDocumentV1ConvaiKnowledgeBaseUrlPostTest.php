<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url": "test-value",
        "name": "test-value",
        "parent_folder_id": "test-value",
        "enable_auto_sync": true,
        "auto_remove": true,
        "minimum_frequency_days": 1
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
