<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AlertingMonitorConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "threshold": 0,
        "relative_increase_threshold": 0,
        "min_failure_count": 1,
        "min_history_bucket_count": 1,
        "min_sample_count": 1,
        "suspect_trigger_threshold": 1,
        "auto_resolve_after_inactive_minutes": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AlertingMonitorConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
