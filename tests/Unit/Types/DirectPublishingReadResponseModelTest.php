<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DirectPublishingReadResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "read_id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1,
        "word_count": 1,
        "char_count": 1,
        "chapters": [
            {
                "chapter_name": "test-value",
                "word_count": 1,
                "char_count": 1,
                "starting_char_offset": 1,
                "has_parsed_html": true,
                "has_summary": true,
                "duration_seconds": 1,
                "file_number": "test-value",
                "is_fallback_name": true,
                "chapter_id": "test-value"
            }
        ],
        "title": "test-value",
        "author": "test-value",
        "description": "test-value",
        "article_image_url": "test-value",
        "language": "test-value",
        "locale": "test-value",
        "display_mode": "text",
        "genre": [
            "Fantasy"
        ],
        "fiction": "test-value",
        "content_type": "test-value",
        "original_file_type": "test-value",
        "target_audience": "children",
        "mature_content": true,
        "safesearch_adult": true,
        "origin": "test-value",
        "publication_date": "test-value",
        "isbn": "test-value",
        "ean": "test-value",
        "legal_terms": {
            "terms": "test-value",
            "start_date": "test-value",
            "end_date": "test-value"
        },
        "content_guidelines_terms": {
            "terms": "test-value",
            "start_date": "test-value",
            "end_date": "test-value"
        },
        "last_updated_from_project_unix": 1,
        "publishing_project_id": "test-value",
        "publishing_state": "test-value",
        "publisher_profile_id": "test-value",
        "quality_score": 1,
        "publisher": "test-value",
        "copyright": "test-value",
        "subtitle": "test-value",
        "distribution_territories": [
            "test-value"
        ],
        "edition": "test-value",
        "contributors": [
            {
                "name": "test-value",
                "role": "test-value",
                "bio": "test-value",
                "profile_id": "test-value"
            }
        ],
        "payout_type": "none",
        "list_price": 1,
        "currency": "usd",
        "original_audio_project_export_id": "test-value",
        "original_audio_document_id": "test-value",
        "series_id": "test-value",
        "volume": 1,
        "published_at_unix": 1,
        "read_slug": "test-value",
        "preview_audio_object": {
            "voice_id": "test-value",
            "text": "test-value",
            "audio_url": "test-value",
            "hls_manifest_url": "test-value",
            "dash_manifest_url": "test-value",
            "is_auto_generated": true,
            "generated_at_unix": 1
        },
        "sample_config": {
            "is_sample": true,
            "parent_id": "test-value",
            "parent_type": "read",
            "chapter_ids": [
                "test-value"
            ]
        },
        "review": {
            "review_status": "approved",
            "reviewed_at_unix": 1,
            "reviewed_by": "test-value",
            "reject_reasons": [
                "lacks_structure"
            ],
            "scores_breakdown": {
                "key": 1
            },
            "rejected_details": "test-value",
            "explanation": "test-value"
        },
        "voice_id": "test-value",
        "can_use_assistant": true,
        "is_voice_changer_on": true,
        "restricted_to_user_email_domains": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\DirectPublishingReadResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
