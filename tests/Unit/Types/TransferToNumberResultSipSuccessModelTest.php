<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToNumberResultSipSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_number_sip_success",
        "status": "success",
        "transfer_number": "test-value",
        "reason": "test-value",
        "note": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToNumberResultSipSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
