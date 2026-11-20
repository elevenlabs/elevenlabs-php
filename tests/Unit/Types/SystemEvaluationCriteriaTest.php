<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SystemEvaluationCriteriaTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_sentiment_score": -1,
        "user_frustration_score": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\SystemEvaluationCriteria::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
