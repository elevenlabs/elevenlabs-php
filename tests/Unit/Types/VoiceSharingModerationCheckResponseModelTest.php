<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceSharingModerationCheckResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceSharingModerationCheckResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
