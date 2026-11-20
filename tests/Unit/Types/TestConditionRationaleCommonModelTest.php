<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestConditionRationaleCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "messages": [
            "test-value"
        ],
        "summary": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TestConditionRationaleCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
