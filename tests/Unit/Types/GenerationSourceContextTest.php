<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GenerationSourceContextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "generation",
        "generation_id": "test-value",
        "prompt": "test-value",
        "model_id": "test-value",
        "model_provider": "test-value",
        "generation_session_id": "test-value",
        "session_iteration_id": "test-value",
        "model_parameters": {
            "key": "test-value"
        },
        "extend_video": {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\GenerationSourceContext::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
