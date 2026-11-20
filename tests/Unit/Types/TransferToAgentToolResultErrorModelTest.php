<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToAgentToolResultErrorModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_agent_error",
        "status": "error",
        "from_agent": "test-value",
        "error": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToAgentToolResultErrorModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
