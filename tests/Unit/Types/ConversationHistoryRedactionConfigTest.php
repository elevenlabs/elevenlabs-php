<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryRedactionConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "entities": [
            "name"
        ],
        "excluded_data_collection_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryRedactionConfig::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
