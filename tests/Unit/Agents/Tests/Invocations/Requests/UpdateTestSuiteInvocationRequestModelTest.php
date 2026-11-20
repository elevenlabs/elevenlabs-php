<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Tests\Invocations\Requests;

use PHPUnit\Framework\TestCase;

class UpdateTestSuiteInvocationRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Tests\Invocations\Requests\UpdateTestSuiteInvocationRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
