<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UrlModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url_string": "test-value",
        "scheme": "test-value",
        "hostname": "test-value",
        "port": 1,
        "path": "test-value",
        "query_string": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UrlModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
