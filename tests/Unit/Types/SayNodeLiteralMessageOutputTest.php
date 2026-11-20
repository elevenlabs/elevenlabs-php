<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SayNodeLiteralMessageOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "literal",
        "text": "test-value",
        "text_translations": {
            "key": {
                "value": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SayNodeLiteralMessageOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
