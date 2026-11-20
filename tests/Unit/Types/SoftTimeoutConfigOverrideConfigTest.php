<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SoftTimeoutConfigOverrideConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message": true,
        "additional_soft_timeout_messages": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SoftTimeoutConfigOverrideConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
