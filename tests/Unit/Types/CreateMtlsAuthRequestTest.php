<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateMtlsAuthRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "mtls",
        "provider": "test-value",
        "client_certificate": "test-value",
        "client_key": "test-value",
        "ca_certificate": "test-value",
        "key_passphrase": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateMtlsAuthRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
