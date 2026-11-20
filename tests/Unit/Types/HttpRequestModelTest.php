<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class HttpRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "http_method": "test-value",
        "url": {
            "url_string": "test-value",
            "scheme": "test-value",
            "hostname": "test-value",
            "port": 1,
            "path": "test-value",
            "query_string": "test-value"
        },
        "user_agent": "test-value",
        "x_forwarded_for": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\HttpRequestModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
