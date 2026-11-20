<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\EnvironmentVariables\Requests;

use PHPUnit\Framework\TestCase;

class UpdateEnvironmentVariableRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "values": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\EnvironmentVariables\Requests\UpdateEnvironmentVariableRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
