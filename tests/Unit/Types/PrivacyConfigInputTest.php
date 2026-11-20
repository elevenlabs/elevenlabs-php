<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PrivacyConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "record_voice": true,
        "retention_days": 1,
        "delete_transcript_and_pii": true,
        "delete_audio": true,
        "apply_to_existing_conversations": true,
        "zero_retention_mode": true,
        "conversation_history_redaction": {
            "enabled": true,
            "entities": [
                "name"
            ],
            "excluded_data_collection_ids": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\PrivacyConfigInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
