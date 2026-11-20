<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GuardrailClassifierVerdictTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "classifier",
        "score": 1,
        "threshold": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\GuardrailClassifierVerdict::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
