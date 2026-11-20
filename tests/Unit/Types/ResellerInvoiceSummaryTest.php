<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResellerInvoiceSummaryTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "invoice_id": "test-value",
        "workspace_id": "test-value",
        "workspace_name": "test-value",
        "status": "paid",
        "amount_cents": 1,
        "currency": "test-value",
        "created_unix": 1,
        "paid_unix": 1,
        "pay_url": "test-value",
        "pdf_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ResellerInvoiceSummary::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
