<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateExotelPhoneNumberRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number": "test-value",
        "label": "test-value",
        "supports_inbound": true,
        "supports_outbound": true,
        "provider": "exotel",
        "agent_id": "test-value",
        "account_sid": "test-value",
        "api_key": "test-value",
        "api_token": "test-value",
        "api_subdomain": "api.in.exotel.com",
        "app_id": "test-value",
        "applet_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateExotelPhoneNumberRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
