<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestToolResultModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "testing_tool_result",
        "status": "success",
        "reason": "test-value",
        "to_agent": "test-value",
        "to_node": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TestToolResultModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
