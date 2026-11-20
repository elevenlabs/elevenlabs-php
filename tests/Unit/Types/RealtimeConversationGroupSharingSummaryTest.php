<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RealtimeConversationGroupSharingSummaryTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "people_count": 1,
        "shared_with_everyone": true,
        "everyone_role": "admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\RealtimeConversationGroupSharingSummary::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
