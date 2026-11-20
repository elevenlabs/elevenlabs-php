<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Realtime\Requests;

use PHPUnit\Framework\TestCase;

class SetConversationGroupRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_group_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Realtime\Requests\SetConversationGroupRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
