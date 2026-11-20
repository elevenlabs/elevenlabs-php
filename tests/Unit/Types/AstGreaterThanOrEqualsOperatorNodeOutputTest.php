<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AstGreaterThanOrEqualsOperatorNodeOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "gte_operator",
        "left": {
            "type": "string_literal",
            "value": "test-value"
        },
        "right": {
            "type": "string_literal",
            "value": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
