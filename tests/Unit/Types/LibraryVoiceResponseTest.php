<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LibraryVoiceResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "public_owner_id": "test-value",
        "voice_id": "test-value",
        "date_unix": 1,
        "name": "test-value",
        "accent": "test-value",
        "gender": "test-value",
        "age": "test-value",
        "descriptive": "test-value",
        "use_case": "test-value",
        "category": "generated",
        "language": "test-value",
        "locale": "test-value",
        "description": "test-value",
        "preview_url": "test-value",
        "usage_character_count_1y": 1,
        "usage_character_count_7d": 1,
        "play_api_usage_character_count_1y": 1,
        "cloned_by_count": 1,
        "rate": 1,
        "fiat_rate": 1,
        "free_users_allowed": true,
        "live_moderation_enabled": true,
        "featured": true,
        "verified_languages": [
            {
                "language": "test-value",
                "model_id": "test-value",
                "accent": "test-value",
                "locale": "test-value",
                "preview_url": "test-value"
            }
        ],
        "notice_period": 1,
        "instagram_username": "test-value",
        "twitter_username": "test-value",
        "youtube_username": "test-value",
        "tiktok_username": "test-value",
        "image_url": "test-value",
        "is_added_by_user": true,
        "is_bookmarked": true
    }
    JSON;

    $instance = \ElevenLabs\Types\LibraryVoiceResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
