<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FieldConflictTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "path": "test-value",
        "section": "conversation_config",
        "base_value": "test-value",
        "source_value": "test-value",
        "target_value": "test-value",
        "id": "test-value",
        "accepts_custom_value": true
    }
    JSON;

    $instance = \ElevenLabs\Types\FieldConflict::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
