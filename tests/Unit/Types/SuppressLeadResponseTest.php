<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SuppressLeadResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "campaign_id": "test-value",
        "lead_id": "test-value",
        "has_calls_in_flight": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SuppressLeadResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
