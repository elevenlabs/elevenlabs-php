<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TicketStatusChangeResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "open",
        "changed_by_user_id": "test-value",
        "changed_at_unix_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TicketStatusChangeResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
