<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResellerInvoiceLineTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "plan",
        "description": "test-value",
        "quantity": 1,
        "amount_cents": 1,
        "period_start_unix": 1,
        "period_end_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ResellerInvoiceLine::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
