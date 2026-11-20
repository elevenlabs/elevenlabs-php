<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Documents\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateFolderV1ConvaiKnowledgeBaseFolderPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "parent_folder_id": "test-value",
        "enable_auto_sync": true,
        "auto_remove": true,
        "minimum_frequency_days": 1
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
