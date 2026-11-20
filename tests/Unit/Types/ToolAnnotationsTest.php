<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ToolAnnotationsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "title": "test-value",
        "readOnlyHint": true,
        "destructiveHint": true,
        "idempotentHint": true,
        "openWorldHint": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ToolAnnotations::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
