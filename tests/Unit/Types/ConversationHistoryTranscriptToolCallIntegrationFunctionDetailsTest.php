<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptToolCallIntegrationFunctionDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "resolved_parameters": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallIntegrationFunctionDetails::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
