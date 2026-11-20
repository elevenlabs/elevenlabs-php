<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ScribeSessionTimeLimitExceededErrorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "session_time_limit_exceeded",
        "error": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ScribeSessionTimeLimitExceededError::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
