<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EnvironmentVariableAuthConnectionValueTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "auth_connection_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\EnvironmentVariableAuthConnectionValue::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
