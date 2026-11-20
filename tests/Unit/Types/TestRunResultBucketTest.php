<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestRunResultBucketTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "test_run_ids": [
            "test-value"
        ],
        "title": "test-value",
        "reason": "test-value",
        "status": "pending"
    }
    JSON;

    $instance = \ElevenLabs\Types\TestRunResultBucket::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
