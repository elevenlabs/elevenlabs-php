<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GuardrailTriggeredGuardrailTriggeredEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "guardrail_name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GuardrailTriggeredGuardrailTriggeredEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
