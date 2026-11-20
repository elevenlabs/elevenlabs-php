<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationProgressTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "scheduled": 1,
        "scheduled_by_type": {
            "key": 1
        },
        "awaiting_permission": 1,
        "in_progress": 1,
        "awaiting_analysis": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationProgress::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
