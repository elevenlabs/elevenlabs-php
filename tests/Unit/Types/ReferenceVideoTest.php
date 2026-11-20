<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReferenceVideoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "generation_id": "test-value",
        "content_asset_id": "test-value",
        "template_node_id": "test-value",
        "studio_clip": {
            "project_id": "test-value",
            "chapter_id": "test-value",
            "clip_type": "video",
            "clip_id": "test-value",
            "block_id": "test-value",
            "preview_url": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ReferenceVideo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
