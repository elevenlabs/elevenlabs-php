<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FlattenedConfigOverridesTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language": "test-value",
        "first_message": "test-value",
        "prompt": "test-value",
        "voice_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\FlattenedConfigOverrides::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
