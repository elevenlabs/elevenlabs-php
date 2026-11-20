<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TeamInviteResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value",
        "outcome": "invited",
        "error_status": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TeamInviteResult::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
