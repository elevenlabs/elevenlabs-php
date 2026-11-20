<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetChaptersResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "chapters": [
            {
                "chapter_id": "test-value",
                "name": "test-value",
                "last_conversion_date_unix": 1,
                "conversion_progress": 1,
                "can_be_downloaded": true,
                "state": "default",
                "has_video": true,
                "has_visual_content": true,
                "voice_ids": [
                    "test-value"
                ],
                "statistics": {
                    "characters_unconverted": 1,
                    "characters_converted": 1,
                    "paragraphs_converted": 1,
                    "paragraphs_unconverted": 1,
                    "credits_needed_to_convert": 1,
                    "voice_statistics": [
                        {
                            "project_voice_ref_id": "test-value",
                            "characters_unconverted": 1,
                            "characters_converted": 1,
                            "credits_needed_to_convert": 1,
                            "voice_id": "test-value"
                        }
                    ]
                },
                "last_conversion_error": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetChaptersResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
