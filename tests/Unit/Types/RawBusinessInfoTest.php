<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RawBusinessInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "company_name": "test-value",
        "description": "test-value",
        "business_phone": "test-value",
        "locations": [
            {
                "name": "test-value",
                "address": "test-value",
                "operating_hours": {
                    "key": "test-value"
                }
            }
        ],
        "business_country": "test-value",
        "business_state": "test-value",
        "suggested_currency": "test-value",
        "suggested_language": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\RawBusinessInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
