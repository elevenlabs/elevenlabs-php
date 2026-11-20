<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ExternalFileSyncInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "google_drive",
        "source_entity_id": "test-value",
        "integration_connection_id": "test-value",
        "source_parent_entity_id": "test-value",
        "source_mime_type": "test-value",
        "source_modified_time": "2023-01-01T12:34:56Z",
        "root_folder_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ExternalFileSyncInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
