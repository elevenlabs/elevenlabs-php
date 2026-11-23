<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationClientDataConversationConfigOverrideTurnSoftTimeoutConfigTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message": "test-value",
        "additional_soft_timeout_messages": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationClientDataConversationConfigOverrideTurnSoftTimeoutConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
