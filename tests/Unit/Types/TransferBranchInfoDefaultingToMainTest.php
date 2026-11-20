<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferBranchInfoDefaultingToMainTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "branch_reason": "defaulting_to_main",
        "branch_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferBranchInfoDefaultingToMain::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
