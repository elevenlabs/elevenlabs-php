<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAiFunctionToolTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "function",
        "name": "test-value",
        "description": "test-value",
        "parameters": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAiFunctionTool::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
