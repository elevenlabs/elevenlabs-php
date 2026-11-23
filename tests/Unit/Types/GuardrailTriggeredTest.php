<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GuardrailTriggeredTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "guardrail_triggered_event": {
            "guardrail_name": "test-value"
        },
        "type": "guardrail_triggered"
    }
    JSON;

    $instance = \ElevenLabs\Types\GuardrailTriggered::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
