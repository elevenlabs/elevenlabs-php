<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ToolResponseMockConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "parameter_conditions": [
            {
                "eval": {
                    "type": "llm",
                    "description": "test-value"
                },
                "path": "test-value"
            }
        ],
        "mock_result": "test-value",
        "is_error": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ToolResponseMockConfigOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
