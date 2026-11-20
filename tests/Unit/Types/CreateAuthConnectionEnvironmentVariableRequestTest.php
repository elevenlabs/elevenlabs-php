<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateAuthConnectionEnvironmentVariableRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "auth_connection",
        "label": "test-value",
        "values": {
            "key": {
                "auth_connection_id": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateAuthConnectionEnvironmentVariableRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
