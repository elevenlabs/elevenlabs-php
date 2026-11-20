<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListCrawlJobsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "crawl_jobs": [
            {
                "type": "discovery",
                "seed_url": "test-value",
                "pattern": "test-value",
                "exclude_patterns": [
                    "test-value"
                ],
                "max_pages": 1,
                "auto_discover": true,
                "status": "queued",
                "pages_identified": 1,
                "pages_scraped": 1,
                "pages_skipped": 1,
                "pages_failed": 1,
                "root_folder_id": "test-value",
                "updated_at": 1,
                "id": "test-value",
                "created_at": 1
            }
        ],
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ListCrawlJobsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
