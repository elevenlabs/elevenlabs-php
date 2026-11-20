<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestConditionResultCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result": "success",
        "rationale": {
            "messages": [
                "test-value"
            ],
            "summary": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\TestConditionResultCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
