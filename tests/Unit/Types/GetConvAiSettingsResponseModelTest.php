<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetConvAiSettingsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_initiation_client_data_webhook": {
            "url": "test-value",
            "request_headers": {
                "key": "test-value"
            }
        },
        "webhooks": {
            "post_call_webhook_id": "test-value",
            "events": [
                "transcript"
            ],
            "transcript_format": "json",
            "exclude_transcript": true,
            "send_audio": true
        },
        "can_use_mcp_servers": true,
        "rag_retention_period_days": 30,
        "conversation_embedding_retention_days": 365,
        "default_livekit_stack": "standard"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetConvAiSettingsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
