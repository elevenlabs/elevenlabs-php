<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpdateGroupSessionSeatsParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "smb_tool_type": "update_group_session_seats"
    }
    JSON;

    $instance = \ElevenLabs\Types\UpdateGroupSessionSeatsParams::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
