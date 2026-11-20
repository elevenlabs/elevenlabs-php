<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ExternalFolderSyncInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "google_drive",
        "source_entity_id": "test-value",
        "integration_connection_id": "test-value",
        "root_folder_id": "test-value",
        "sync_cursor": "test-value",
        "last_sync_at": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ExternalFolderSyncInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
