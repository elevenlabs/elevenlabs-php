<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OTelTracePayloadTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "resourceSpans": [
            {
                "resource": {
                    "attributes": [
                        {
                            "key": "test-value",
                            "value": {
                                "key": "test-value"
                            }
                        }
                    ]
                },
                "scopeSpans": [
                    {
                        "scope": {
                            "name": "test-value",
                            "version": "test-value"
                        },
                        "spans": [
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
                        ]
                    }
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\OTelTracePayload::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
