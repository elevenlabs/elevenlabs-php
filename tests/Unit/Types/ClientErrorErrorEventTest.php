<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientErrorErrorEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "code": 1,
        "error_name": "test-value",
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientErrorErrorEvent::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
