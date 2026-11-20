<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionProcedureTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "trigger": "test-value",
        "body": "test-value",
        "id": "test-value",
        "created_at_unix": 1,
        "source_key": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionProcedure::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
