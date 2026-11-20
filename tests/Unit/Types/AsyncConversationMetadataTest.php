<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AsyncConversationMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "delivery_status": "pending",
        "delivery_timestamp": 1,
        "delivery_error": "test-value",
        "external_system": "test-value",
        "external_id": "test-value",
        "external_link": "test-value",
        "retry_count": 1,
        "last_retry_timestamp": 1,
        "last_processed_external_message_id": "test-value",
        "integration_trigger_id": "test-value",
        "platform_metadata": {
            "conversation_initiation_source": "plain_integration",
            "thread_id": "test-value",
            "workspace_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AsyncConversationMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
