<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoicesNotPermittedWarningTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "voices_not_permitted",
        "speaker_ids": [
            "test-value"
        ],
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VoicesNotPermittedWarning::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
