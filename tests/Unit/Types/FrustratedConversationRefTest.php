<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FrustratedConversationRefTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "agent_id": "test-value",
        "start_time_unix_secs": 1,
        "overall_label": "positive",
        "overall_sentiment_score": 1,
        "overall_frustration_score": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\FrustratedConversationRef::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
