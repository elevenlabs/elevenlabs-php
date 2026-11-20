<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppOpeningMessageTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "template_name": "test-value",
        "wamid": "test-value",
        "sent_at_unix": 1,
        "delivered_at_unix": 1,
        "read_at_unix": 1,
        "replied_at_unix": 1,
        "failed_at_unix": 1,
        "error_code": "test-value",
        "pricing_category": "test-value",
        "billable": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppOpeningMessage::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
