<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AssetResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "asset_id": "test-value",
        "name": "test-value",
        "mime_type": "test-value",
        "created_at_unix": 1,
        "content_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AssetResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
