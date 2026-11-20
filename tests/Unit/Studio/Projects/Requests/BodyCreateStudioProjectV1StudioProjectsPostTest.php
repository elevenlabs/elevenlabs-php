<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateStudioProjectV1StudioProjectsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "default_title_voice_id": "test-value",
        "default_paragraph_voice_id": "test-value",
        "default_model_id": "test-value",
        "from_url": "test-value",
        "from_content_json": "test-value",
        "quality_preset": "standard",
        "title": "test-value",
        "author": "test-value",
        "description": "test-value",
        "genres": [
            "test-value"
        ],
        "target_audience": "children",
        "language": "test-value",
        "content_type": "test-value",
        "original_publication_date": "test-value",
        "mature_content": true,
        "isbn_number": "test-value",
        "acx_volume_normalization": true,
        "volume_normalization": true,
        "pronunciation_dictionary_locators": [
            "test-value"
        ],
        "callback_url": "test-value",
        "fiction": "fiction",
        "apply_text_normalization": "auto",
        "auto_convert": true,
        "auto_assign_voices": true,
        "source_type": "blank",
        "voice_settings": [
            "test-value"
        ],
        "create_publishing_read": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Requests\BodyCreateStudioProjectV1StudioProjectsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
