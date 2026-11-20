<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SmbClientAccessConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enable_secure_mode": true,
        "identity_verification_enabled": true,
        "identity_verification_email_enabled": true,
        "identity_verification_sms_enabled": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SmbClientAccessConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
