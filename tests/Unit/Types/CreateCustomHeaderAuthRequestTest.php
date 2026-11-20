<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateCustomHeaderAuthRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "auth_type": "custom_header_auth",
        "provider": "test-value",
        "header_name": "test-value",
        "token": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateCustomHeaderAuthRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
