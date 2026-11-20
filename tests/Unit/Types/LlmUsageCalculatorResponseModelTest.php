<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmUsageCalculatorResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "llm_prices": [
            {
                "llm": "gpt-4o-mini",
                "price_per_minute": 1,
                "price_per_message": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmUsageCalculatorResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
