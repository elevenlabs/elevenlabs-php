<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ExotelColdBlindTransferConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "transfer_destination": {
            "destination": "test-value",
            "type": "phone"
        },
        "type": "exotel_cold_blind_transfer"
    }
    JSON;

    $instance = \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
