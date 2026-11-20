<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AutoGenerationMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "stable_topic_id": "test-value",
        "criteria_id": "test-value",
        "topic_label": "test-value",
        "source_conversation_id": "test-value",
        "generated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AutoGenerationMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
