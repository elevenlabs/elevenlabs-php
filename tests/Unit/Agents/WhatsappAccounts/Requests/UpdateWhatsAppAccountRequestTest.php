<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\WhatsappAccounts\Requests;

use PHPUnit\Framework\TestCase;

class UpdateWhatsAppAccountRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "assigned_agent_id": "test-value",
        "enable_messaging": true,
        "enable_audio_message_response": true,
        "enable_typing_indicator": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\WhatsappAccounts\Requests\UpdateWhatsAppAccountRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
