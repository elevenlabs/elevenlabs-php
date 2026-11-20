<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SentimentAggregateTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "scored_conversation_count": 1,
        "positive_count": 1,
        "neutral_count": 1,
        "negative_count": 1,
        "average_sentiment_score": 1,
        "average_frustration_score": 1,
        "recent_scored_conversation_count": 1,
        "recent_positive_count": 1,
        "recent_neutral_count": 1,
        "recent_negative_count": 1,
        "recent_average_sentiment_score": 1,
        "recent_average_frustration_score": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\SentimentAggregate::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
