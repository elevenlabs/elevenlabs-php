<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class InternalKbCrawlPageTimingTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url": "test-value",
        "doc_id": "test-value",
        "read_ms": 1,
        "index_ms": 1,
        "html_len": 1,
        "skipped": true,
        "error": true
    }
    JSON;

    $instance = \ElevenLabs\Types\InternalKbCrawlPageTiming::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
