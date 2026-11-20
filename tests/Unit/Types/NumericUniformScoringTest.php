<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class NumericUniformScoringTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mode": "numeric_uniform",
        "max_score": 1,
        "instructions": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\NumericUniformScoring::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
