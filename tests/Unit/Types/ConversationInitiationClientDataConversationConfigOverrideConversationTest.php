<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationClientDataConversationConfigOverrideConversationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text_only": true,
        "max_duration_seconds": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationClientDataConversationConfigOverrideConversation::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
