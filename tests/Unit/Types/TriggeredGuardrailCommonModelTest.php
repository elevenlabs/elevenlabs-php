<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TriggeredGuardrailCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "guardrail_type": "custom",
        "guardrail_name": "test-value",
        "execution_mode": "streaming",
        "guardrail_details": {
            "type": "llm",
            "rationale": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\TriggeredGuardrailCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
