<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OrderMediaResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "media_id": "test-value",
        "name": "test-value",
        "content_type": "test-value",
        "language": "test-value",
        "signed_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\OrderMediaResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
