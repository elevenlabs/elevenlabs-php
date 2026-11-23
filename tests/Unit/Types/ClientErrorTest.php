<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientErrorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "error_event": {
            "code": 1,
            "error_name": "test-value",
            "message": "test-value"
        },
        "type": "client_error"
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientError::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
