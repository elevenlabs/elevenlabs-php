<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DependentAvailableAgentIdentifierTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "referenced_resource_ids": [
            "test-value"
        ],
        "id": "test-value",
        "name": "test-value",
        "type": "available",
        "created_at_unix_secs": 1,
        "access_level": "admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\DependentAvailableAgentIdentifier::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
