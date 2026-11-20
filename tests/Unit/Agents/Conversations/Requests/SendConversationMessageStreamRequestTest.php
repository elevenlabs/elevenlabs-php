<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Requests;

use PHPUnit\Framework\TestCase;

class SendConversationMessageStreamRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "input": [
            {
                "type": "user_message",
                "content": [
                    {
                        "type": "text",
                        "text": "test-value"
                    }
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Agents\Conversations\Requests\SendConversationMessageStreamRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
