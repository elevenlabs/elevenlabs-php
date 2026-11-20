<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ZendeskPlatformMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_initiation_source": "zendesk_integration",
        "ticket_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ZendeskPlatformMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
