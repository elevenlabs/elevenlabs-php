<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AstConditionalOperatorNodeOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "conditional_operator",
        "condition": {
            "type": "string_literal",
            "value": "test-value"
        },
        "trueExpression": {
            "type": "string_literal",
            "value": "test-value"
        },
        "falseExpression": {
            "type": "string_literal",
            "value": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AstConditionalOperatorNodeOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
