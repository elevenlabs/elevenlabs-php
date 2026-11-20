<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BranchSyncStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "last_attempt": {
            "outcome": "succeeded",
            "attempted_at": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\BranchSyncStatus::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
