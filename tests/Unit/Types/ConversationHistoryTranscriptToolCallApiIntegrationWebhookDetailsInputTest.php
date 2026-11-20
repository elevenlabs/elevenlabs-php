<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "api_integration_webhook",
        "integration_id": "test-value",
        "credential_id": "test-value",
        "integration_connection_id": "test-value",
        "webhook_details": {
            "type": "webhook",
            "method": "test-value",
            "url": "test-value",
            "headers": {
                "key": "test-value"
            },
            "path_params": {
                "key": "test-value"
            },
            "query_params": {
                "key": "test-value"
            },
            "body": "test-value"
        },
        "function_details": {
            "resolved_parameters": {
                "key": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
