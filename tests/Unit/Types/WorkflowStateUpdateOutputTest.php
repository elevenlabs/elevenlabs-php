<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowStateUpdateOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "dynamic_variable",
        "variable_name": "test-value",
        "expression": {
            "type": "string_literal",
            "value": "test-value"
        },
        "required": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowStateUpdateOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
