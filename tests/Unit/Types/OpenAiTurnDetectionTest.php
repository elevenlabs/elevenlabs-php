<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAiTurnDetectionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "semantic_vad",
        "eagerness": "low",
        "create_response": true,
        "interrupt_response": true,
        "threshold": 1,
        "prefix_padding_ms": 1,
        "silence_duration_ms": 1,
        "turn_timeout": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAiTurnDetection::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
