<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToNumberResultTwilioSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_number_twilio_success",
        "status": "success",
        "transfer_number": "test-value",
        "reason": "test-value",
        "client_message": "test-value",
        "agent_message": "test-value",
        "conference_name": "test-value",
        "post_dial_digits": "test-value",
        "note": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
