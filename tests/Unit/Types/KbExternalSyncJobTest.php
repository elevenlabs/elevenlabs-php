<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KbExternalSyncJobTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "google_drive",
        "folder_id": "test-value",
        "integration_connection_id": "test-value",
        "triggered_by": "on_demand",
        "status": "queued",
        "sync_type": "full",
        "items_identified": 1,
        "items_processed": 1,
        "error_message": "test-value",
        "started_at": 1,
        "completed_at": 1,
        "updated_at": 1,
        "id": "test-value",
        "created_at": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\KbExternalSyncJob::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
