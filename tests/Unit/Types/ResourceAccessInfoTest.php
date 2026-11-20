<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ResourceAccessInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_creator": true,
        "creator_name": "test-value",
        "creator_email": "test-value",
        "role": "admin",
        "anonymous_access_level_override": "admin",
        "access_source": "creator"
    }
    JSON;

    $instance = \ElevenLabs\Types\ResourceAccessInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
