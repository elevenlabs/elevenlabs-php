<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class IntegerSchemaTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "description": "test-value",
        "type": "integer"
    }
    JSON;

    $instance = \ElevenLabs\Types\IntegerSchema::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
