<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\CrawlJobs\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateCrawlJobV1ConvaiKnowledgeBaseCrawlPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url": "test-value",
        "max_depth": 1,
        "max_pages": 1,
        "pattern": "test-value",
        "exclude_patterns": [
            "test-value"
        ],
        "sitemap_urls": [
            "test-value"
        ],
        "parent_folder_id": "test-value",
        "enable_auto_sync": true,
        "auto_remove": true,
        "auto_discover": true,
        "minimum_frequency_days": 1
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\CrawlJobs\Requests\BodyCreateCrawlJobV1ConvaiKnowledgeBaseCrawlPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
