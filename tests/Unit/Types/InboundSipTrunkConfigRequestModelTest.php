<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InboundSipTrunkConfigRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "allowed_addresses": [
            "test-value"
        ],
        "allowed_numbers": [
            "test-value"
        ],
        "media_encryption": "disabled",
        "credentials": {
            "username": "test-value",
            "password": "test-value"
        },
        "remote_domains": [
            "test-value"
        ],
        "attributes_to_headers": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\InboundSipTrunkConfigRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
