<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AssignableUserResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_id": "test-value",
        "email": "test-value",
        "first_name": "test-value",
        "is_service_account": true,
        "has_access": true
    }
    JSON;

    $instance = \ElevenLabs\Types\AssignableUserResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
