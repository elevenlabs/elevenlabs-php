<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetPhoneNumberExotelResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number": "test-value",
        "label": "test-value",
        "supports_inbound": true,
        "supports_outbound": true,
        "phone_number_id": "test-value",
        "assigned_agent": {
            "agent_id": "test-value",
            "agent_name": "test-value",
            "environment": "test-value",
            "branch_id": "test-value"
        },
        "provider": "exotel"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetPhoneNumberExotelResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
