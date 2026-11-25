<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubtitlingSessionStartedTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "session_started",
        "session_id": "test-value",
        "client_session_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SubtitlingSessionStarted::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
