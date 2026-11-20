<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryEvaluationCriteriaResultCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "criteria_id": "test-value",
        "result": "success",
        "rationale": "test-value",
        "scoring_mode": "binary",
        "score": 1,
        "max_score": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
