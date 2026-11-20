<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpdateBasicAuthRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "auth_type": "basic_auth",
        "provider": "test-value",
        "username": "test-value",
        "password": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UpdateBasicAuthRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
