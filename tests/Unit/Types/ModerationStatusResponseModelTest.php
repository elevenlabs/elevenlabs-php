<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ModerationStatusResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_in_probation": true,
        "enterprise_check_nogo_voice": true,
        "enterprise_check_block_nogo_voice": true,
        "never_live_moderate": true,
        "nogo_voice_similar_voice_upload_count": 1,
        "enterprise_background_moderation_enabled": true,
        "is_ivc_captcha_required": true,
        "safety_status": "appeal_approved",
        "warning_status": "warning",
        "on_watchlist": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ModerationStatusResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
