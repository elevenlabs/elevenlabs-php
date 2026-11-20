<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClosedOutcomeTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "closed",
        "reason": "withdrawn",
        "at": 1,
        "by_user_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ClosedOutcome::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
