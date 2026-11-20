<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Realtime\Requests;

use PHPUnit\Framework\TestCase;

class UpdateRealtimeConversationGroupRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Realtime\Requests\UpdateRealtimeConversationGroupRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
