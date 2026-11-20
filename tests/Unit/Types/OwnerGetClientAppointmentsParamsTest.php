<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OwnerGetClientAppointmentsParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "include_cancelled": true,
        "smb_tool_type": "owner_get_client_appointments"
    }
    JSON;

    $instance = \ElevenLabs\Types\OwnerGetClientAppointmentsParams::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
