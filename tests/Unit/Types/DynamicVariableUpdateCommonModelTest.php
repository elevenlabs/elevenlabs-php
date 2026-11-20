<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DynamicVariableUpdateCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "variable_name": "test-value",
        "old_value": "test-value",
        "new_value": "test-value",
        "updated_at": 1,
        "tool_name": "test-value",
        "tool_request_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DynamicVariableUpdateCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
