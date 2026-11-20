<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TopicEvaluationCriteriaAggregateTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "criteria_id": "test-value",
        "success_count": 1,
        "failure_count": 1,
        "unknown_count": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TopicEvaluationCriteriaAggregate::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
