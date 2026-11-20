<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationTokenResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "conversation_token": "test-value",
        "expiration_time_unix_secs": 1,
        "conversation_id": "test-value",
        "purpose": "signed_url",
        "token_requester_user_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationTokenResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
