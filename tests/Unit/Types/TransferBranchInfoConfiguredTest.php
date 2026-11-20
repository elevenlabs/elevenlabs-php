<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferBranchInfoConfiguredTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "branch_reason": "configured",
        "branch_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferBranchInfoConfigured::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
