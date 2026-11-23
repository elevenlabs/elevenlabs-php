<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationClientDataConversationConfigOverrideAsrTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "keywords": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationClientDataConversationConfigOverrideAsr::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
