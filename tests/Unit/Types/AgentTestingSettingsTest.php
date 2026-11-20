<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentTestingSettingsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "attached_tests": [
            {
                "test_id": "test-value",
                "workflow_node_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentTestingSettings::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
