<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToNumberResultAmazonConnectSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_number_amazon_connect_success",
        "status": "success",
        "reason": "test-value",
        "client_message": "test-value",
        "note": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
