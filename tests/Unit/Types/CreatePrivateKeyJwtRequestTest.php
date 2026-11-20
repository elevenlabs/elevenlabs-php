<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreatePrivateKeyJwtRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "private_key_jwt",
        "provider": "test-value",
        "algorithm": "HS256",
        "key_id": "test-value",
        "issuer": "test-value",
        "audience": "test-value",
        "subject": "test-value",
        "expiration_seconds": 60,
        "extra_params": {
            "key": "test-value"
        },
        "extra_headers": {
            "key": "test-value"
        },
        "secret_key": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CreatePrivateKeyJwtRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
