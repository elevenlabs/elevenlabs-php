<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DynamicVariableAssignmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "response",
        "dynamic_variable": "test-value",
        "value_path": "test-value",
        "sanitize": true,
        "preserve_native_type": true
    }
    JSON;

    $instance = \ElevenLabs\Types\DynamicVariableAssignment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
