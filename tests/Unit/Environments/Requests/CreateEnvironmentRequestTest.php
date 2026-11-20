<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Environments\Requests;

use PHPUnit\Framework\TestCase;

class CreateEnvironmentRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Environments\Requests\CreateEnvironmentRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
