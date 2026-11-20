<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InvoiceResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "amount_due_cents": 1,
        "subtotal_cents": 1,
        "tax_cents": 1,
        "discount_percent_off": 1,
        "discount_amount_off": 1,
        "discounts": [
            {
                "discount_percent_off": 1,
                "discount_amount_off": 1
            }
        ],
        "next_payment_attempt_unix": 1,
        "payment_intent_status": "canceled",
        "payment_intent_statusses": [
            "canceled"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\InvoiceResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
