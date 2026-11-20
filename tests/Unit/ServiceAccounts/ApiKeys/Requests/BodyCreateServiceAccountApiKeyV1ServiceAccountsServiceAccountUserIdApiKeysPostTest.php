<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\ServiceAccounts\ApiKeys\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPostTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "permissions": [
            "text_to_speech"
        ],
        "character_limit": 1,
        "allowed_ips": [
            "test-value"
        ],
        "third_party_disable_allowed": true,
        "tts_concurrency_limit": 1,
        "dubbing_concurrency_limit": 1,
        "music_concurrency_limit": 1,
        "expires_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\ServiceAccounts\ApiKeys\Requests\BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
