<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingMediaReferenceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "src": "test-value",
        "content_type": "test-value",
        "bucket_name": "test-value",
        "random_path_slug": "test-value",
        "duration_secs": 1,
        "is_audio": true,
        "url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingMediaReference::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
