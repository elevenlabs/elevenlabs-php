<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlainPlatformMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_initiation_source": "plain_integration",
        "thread_id": "test-value",
        "workspace_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PlainPlatformMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
