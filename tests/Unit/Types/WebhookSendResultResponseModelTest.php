<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WebhookSendResultResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "delivery_id": "test-value",
        "outcome": "delivered",
        "response_code": 1,
        "latency_ms": 1,
        "response_content_type": "test-value",
        "response_body_bytes": 1,
        "failure_origin": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WebhookSendResultResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
