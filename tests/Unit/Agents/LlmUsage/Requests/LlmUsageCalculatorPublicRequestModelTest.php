<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\LlmUsage\Requests;

use PHPUnit\Framework\TestCase;

class LlmUsageCalculatorPublicRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "prompt_length": 1,
        "number_of_pages": 1,
        "rag_enabled": true,
        "service_tier": "standard"
    }
    JSON;

    $instance = \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorPublicRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
