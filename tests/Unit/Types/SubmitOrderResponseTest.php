<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubmitOrderResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "order_id": "test-value",
        "state": "open",
        "submitted_at": "2023-01-01T12:34:56Z"
    }
    JSON;

    $instance = \ElevenLabs\Types\SubmitOrderResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
