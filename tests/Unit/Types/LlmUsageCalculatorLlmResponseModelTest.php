<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmUsageCalculatorLlmResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "llm": "gpt-4o-mini",
        "price_per_minute": 1,
        "price_per_message": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmUsageCalculatorLlmResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
