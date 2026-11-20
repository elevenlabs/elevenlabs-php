<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToNumberResultExotelSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_number_exotel_success",
        "status": "success",
        "transfer_number": "test-value",
        "reason": "test-value",
        "agent_message": "test-value",
        "note": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
