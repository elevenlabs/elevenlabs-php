<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WatermarkDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "product": "test-value",
        "model": "test-value",
        "generated_at": "test-value",
        "unique_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WatermarkDetails::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
