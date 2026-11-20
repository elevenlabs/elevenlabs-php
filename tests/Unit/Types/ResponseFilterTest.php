<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResponseFilterTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mode": "all",
        "filters": [
            "test-value"
        ],
        "content_type": "application/json"
    }
    JSON;

    $instance = \ElevenLabs\Types\ResponseFilter::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
