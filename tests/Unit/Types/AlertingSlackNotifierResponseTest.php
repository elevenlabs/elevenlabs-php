<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AlertingSlackNotifierResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "integration",
        "integration_type": "slack",
        "connection_id": "test-value",
        "channel_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AlertingSlackNotifierResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
