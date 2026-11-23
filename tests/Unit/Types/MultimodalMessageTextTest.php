<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class MultimodalMessageTextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "type": "user_message",
        "text": "test-value",
        "user_identifier": "test-value",
        "source_medium": "audio"
    }
    JSON;

    $instance = \ElevenLabs\Types\MultimodalMessageText::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
