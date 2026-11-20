<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AttachedSystemEvaluationRefTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "system",
        "analysis_item_id": "__system_eval_criteria_sentiment",
        "scope": "conversation",
        "weight": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AttachedSystemEvaluationRef::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
