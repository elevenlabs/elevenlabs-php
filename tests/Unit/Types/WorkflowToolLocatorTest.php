<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowToolLocatorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_id": "test-value",
        "schema_overrides": {
            "key": {
                "source": "constant",
                "constant_value": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowToolLocator::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
