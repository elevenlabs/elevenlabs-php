<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryMultivoiceMessageModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "parts": [
            {
                "text": "test-value",
                "voice_label": "test-value",
                "time_in_call_secs": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryMultivoiceMessageModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
