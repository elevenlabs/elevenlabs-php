<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RetryPolicyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "retry_delay_seconds": 1,
        "max_short_retries": 0,
        "max_total_calls": 1,
        "max_callbacks": 0,
        "max_redirects": 0,
        "interval_placement": "start",
        "rotate_step_seconds": 1,
        "max_consecutive_failures_per_number": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\RetryPolicy::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
