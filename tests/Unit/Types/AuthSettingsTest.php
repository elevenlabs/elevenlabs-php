<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AuthSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enable_auth": true,
        "allowlist": [
            {
                "hostname": "test-value"
            }
        ],
        "require_origin_header": true,
        "shareable_token": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AuthSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
