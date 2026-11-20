<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ApiIntegrationWebhookOverridesTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "schema_overrides": {
            "key": {
                "source": "constant",
                "constant_value": "test-value"
            }
        },
        "response_filter_mode": "all",
        "response_filters": [
            "test-value"
        ],
        "request_headers": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ApiIntegrationWebhookOverrides::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
