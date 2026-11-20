<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UnitTestToolCallParameterTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "eval": {
            "type": "llm",
            "description": "test-value"
        },
        "path": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UnitTestToolCallParameter::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
