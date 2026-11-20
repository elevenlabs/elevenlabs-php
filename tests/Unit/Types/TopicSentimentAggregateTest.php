<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TopicSentimentAggregateTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sentiment": {
            "count": 1,
            "sum": 1,
            "min": 1,
            "max": 1
        },
        "frustration": {
            "count": 1,
            "sum": 1,
            "min": 1,
            "max": 1
        },
        "positive_count": 1,
        "neutral_count": 1,
        "negative_count": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TopicSentimentAggregate::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
