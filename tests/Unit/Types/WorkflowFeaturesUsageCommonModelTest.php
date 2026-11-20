<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowFeaturesUsageCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "tool_node": {
            "enabled": true,
            "used": true
        },
        "standalone_agent_node": {
            "enabled": true,
            "used": true
        },
        "phone_number_node": {
            "enabled": true,
            "used": true
        },
        "end_node": {
            "enabled": true,
            "used": true
        },
        "override_agent_node": {
            "enabled": true,
            "used": true
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowFeaturesUsageCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
