<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateSecretEnvironmentVariableRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "secret",
        "label": "test-value",
        "values": {
            "key": {
                "secret_id": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateSecretEnvironmentVariableRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
