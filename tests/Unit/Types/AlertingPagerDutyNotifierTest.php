<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AlertingPagerDutyNotifierTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "integration",
        "integration_type": "pagerduty",
        "connection_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AlertingPagerDutyNotifier::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
