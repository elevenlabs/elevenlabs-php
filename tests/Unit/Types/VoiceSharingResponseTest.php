<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSharingResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "enabled",
        "history_item_sample_id": "test-value",
        "date_unix": 1,
        "whitelisted_emails": [
            "test-value"
        ],
        "public_owner_id": "test-value",
        "original_voice_id": "test-value",
        "financial_rewards_enabled": true,
        "free_users_allowed": true,
        "live_moderation_enabled": true,
        "rate": 1,
        "fiat_rate": 1,
        "notice_period": 1,
        "disable_at_unix": 1,
        "voice_mixing_allowed": true,
        "featured": true,
        "category": "generated",
        "reader_app_enabled": true,
        "image_url": "test-value",
        "ban_reason": "test-value",
        "liked_by_count": 1,
        "cloned_by_count": 1,
        "name": "test-value",
        "description": "test-value",
        "labels": {
            "key": "test-value"
        },
        "review_status": "not_requested",
        "review_message": "test-value",
        "enabled_in_library": true,
        "instagram_username": "test-value",
        "twitter_username": "test-value",
        "youtube_username": "test-value",
        "tiktok_username": "test-value",
        "moderation_check": {
            "date_checked_unix": 1,
            "name_value": "test-value",
            "name_check": true,
            "description_value": "test-value",
            "description_check": true,
            "sample_ids": [
                "test-value"
            ],
            "sample_checks": [
                1
            ],
            "captcha_ids": [
                "test-value"
            ],
            "captcha_checks": [
                1
            ]
        },
        "reader_restricted_on": [
            {
                "resource_type": "read",
                "resource_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSharingResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
