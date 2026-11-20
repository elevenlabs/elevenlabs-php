<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Tests\Requests;

use PHPUnit\Framework\TestCase;

class ListTestsByIdsRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "test_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Agents\Tests\Requests\ListTestsByIdsRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
