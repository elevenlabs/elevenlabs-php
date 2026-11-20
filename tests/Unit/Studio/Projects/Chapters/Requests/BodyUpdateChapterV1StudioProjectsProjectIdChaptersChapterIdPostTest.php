<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Chapters\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateChapterV1StudioProjectsProjectIdChaptersChapterIdPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "content": {
            "blocks": [
                {
                    "sub_type": "p",
                    "nodes": [
                        {
                            "type": "tts_node",
                            "text": "test-value",
                            "voice_id": "test-value"
                        }
                    ],
                    "block_id": "test-value"
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Chapters\Requests\BodyUpdateChapterV1StudioProjectsProjectIdChaptersChapterIdPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
