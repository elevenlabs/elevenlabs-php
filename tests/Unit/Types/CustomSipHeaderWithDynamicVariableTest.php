<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CustomSipHeaderWithDynamicVariableTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "value": "test-value",
        "type": "dynamic",
        "key": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CustomSipHeaderWithDynamicVariable::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
