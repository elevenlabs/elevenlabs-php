<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RecipientDeliveryCountsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "sent": 1,
        "delivered": 1,
        "read": 1,
        "replied": 1,
        "failed": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\RecipientDeliveryCounts::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
