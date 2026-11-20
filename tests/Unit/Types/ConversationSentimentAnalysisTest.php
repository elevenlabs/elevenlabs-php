<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationSentimentAnalysisTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "overall_label": "positive",
        "overall_sentiment_score": -1,
        "overall_frustration_score": 0,
        "min_user_sentiment_score": -1,
        "max_user_frustration_score": 0,
        "num_scored_user_turns": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationSentimentAnalysis::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
