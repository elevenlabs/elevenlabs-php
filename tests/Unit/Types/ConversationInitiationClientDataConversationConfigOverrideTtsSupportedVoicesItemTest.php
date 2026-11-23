<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationInitiationClientDataConversationConfigOverrideTtsSupportedVoicesItemTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "label": "test-value",
        "voice_id": "test-value",
        "description": "test-value",
        "language": "test-value",
        "model_family": "turbo",
        "optimize_streaming_latency": 0,
        "stability": 0,
        "speed": 0.7,
        "similarity_boost": 0,
        "clone_strength": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationInitiationClientDataConversationConfigOverrideTtsSupportedVoicesItem::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
