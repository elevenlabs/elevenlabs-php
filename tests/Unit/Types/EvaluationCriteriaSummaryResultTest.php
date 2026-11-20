<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EvaluationCriteriaSummaryResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result": "success",
        "score": 1,
        "max_score": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\EvaluationCriteriaSummaryResult::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
