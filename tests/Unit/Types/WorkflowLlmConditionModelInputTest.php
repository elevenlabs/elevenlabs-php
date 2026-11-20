<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowLlmConditionModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "label": "test-value",
        "type": "llm",
        "condition": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowLlmConditionModelInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
