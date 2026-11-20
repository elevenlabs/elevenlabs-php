<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DetectedEntityTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "entity_type": "test-value",
        "start_char": 1,
        "end_char": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DetectedEntity::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
