<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DynamicVariablesConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "dynamic_variable_placeholders": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\DynamicVariablesConfigWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
