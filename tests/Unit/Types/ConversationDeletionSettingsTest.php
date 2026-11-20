<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationDeletionSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "deletion_time_unix_secs": 1,
        "deleted_logs_at_time_unix_secs": 1,
        "deleted_audio_at_time_unix_secs": 1,
        "deleted_transcript_at_time_unix_secs": 1,
        "delete_transcript_and_pii": true,
        "delete_audio": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationDeletionSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
