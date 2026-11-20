<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpdateBearerAuthRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "auth_type": "bearer_auth",
        "provider": "test-value",
        "token": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UpdateBearerAuthRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
