<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TranslateSessionStartedTest extends TestCase
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

    $instance = \ElevenLabs\Types\TranslateSessionStarted::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
