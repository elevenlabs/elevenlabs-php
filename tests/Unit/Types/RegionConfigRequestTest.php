<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RegionConfigRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "region_id": "us1",
        "token": "test-value",
        "edge_location": "ashburn"
    }
    JSON;

    $instance = \ElevenLabs\Types\RegionConfigRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
