<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_response_metadata_event": {
            "metadata": {
                "key": "test-value"
            },
            "event_id": 1
        },
        "type": "agent_response_metadata"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
