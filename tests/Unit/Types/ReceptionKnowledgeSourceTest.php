<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionKnowledgeSourceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "file",
        "source_url": "test-value",
        "last_scraped_at_unix": 1,
        "original_filename": "test-value",
        "content_type": "test-value",
        "file_size_bytes": 1,
        "status": "processing",
        "error_message": "test-value",
        "failure_reason": "blocked_url",
        "crawl_entire_site": true,
        "scraped_pages_count": 1,
        "content_preview": "test-value",
        "processing_started_at_unix": 1,
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionKnowledgeSource::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
