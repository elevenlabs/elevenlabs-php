<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RawLocationInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "address": "test-value",
        "operating_hours": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\RawLocationInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
