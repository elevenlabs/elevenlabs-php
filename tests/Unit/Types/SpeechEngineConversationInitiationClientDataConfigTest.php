<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeechEngineConversationInitiationClientDataConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "first_message": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeechEngineConversationInitiationClientDataConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
