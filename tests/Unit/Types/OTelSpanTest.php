<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OTelSpanTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "traceId": "test-value",
        "spanId": "test-value",
        "parentSpanId": "test-value",
        "name": "test-value",
        "kind": 1,
        "startTimeUnixNano": "test-value",
        "endTimeUnixNano": "test-value",
        "attributes": [
            {
                "key": "test-value",
                "value": {
                    "key": "test-value"
                }
            }
        ],
        "status": {
            "code": 1,
            "message": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\OTelSpan::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
