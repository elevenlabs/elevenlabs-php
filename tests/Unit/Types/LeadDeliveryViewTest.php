<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LeadDeliveryViewTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "pending",
        "stage": "queued",
        "sent_at_unix": 1,
        "delivered_at_unix": 1,
        "read_at_unix": 1,
        "replied_at_unix": 1,
        "failed_at_unix": 1,
        "error_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\LeadDeliveryView::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
