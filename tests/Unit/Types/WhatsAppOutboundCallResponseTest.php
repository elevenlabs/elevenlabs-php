<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppOutboundCallResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "success": true,
        "message": "test-value",
        "conversation_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppOutboundCallResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
