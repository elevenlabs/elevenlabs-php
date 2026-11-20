<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppCallPermissionRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "state": "blocked",
        "requested_at_unix": 1,
        "responded_at_unix": 1,
        "permanent": true,
        "granted_by_user_call": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppCallPermissionRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
