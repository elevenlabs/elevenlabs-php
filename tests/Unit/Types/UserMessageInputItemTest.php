<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UserMessageInputItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "user_message",
        "content": [
            {
                "type": "text",
                "text": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\UserMessageInputItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
