<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DependentUnknownAgentIdentifierTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "referenced_resource_ids": [
            "test-value"
        ],
        "id": "test-value",
        "type": "unknown"
    }
    JSON;

    $instance = \ElevenLabs\Types\DependentUnknownAgentIdentifier::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
