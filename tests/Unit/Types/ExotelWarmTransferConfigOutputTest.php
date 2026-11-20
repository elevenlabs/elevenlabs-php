<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ExotelWarmTransferConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "transfer_destination": {
            "destination": "test-value",
            "type": "phone"
        },
        "type": "exotel_warm_transfer"
    }
    JSON;

    $instance = \ElevenLabs\Types\ExotelWarmTransferConfigOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
