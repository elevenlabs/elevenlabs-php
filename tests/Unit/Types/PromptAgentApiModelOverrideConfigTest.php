<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PromptAgentApiModelOverrideConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "prompt": true,
        "llm": true,
        "reasoning_effort": true,
        "tool_ids": true,
        "tool_ids_strict": true,
        "native_mcp_server_ids": true,
        "knowledge_base": true
    }
    JSON;

    $instance = \ElevenLabs\Types\PromptAgentApiModelOverrideConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
