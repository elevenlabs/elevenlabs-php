<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WatermarkCheckTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_detected": true,
        "details": {
            "product": "test-value",
            "model": "test-value",
            "generated_at": "test-value",
            "unique_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WatermarkCheck::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
