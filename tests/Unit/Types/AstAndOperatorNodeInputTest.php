<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AstAndOperatorNodeInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "and_operator",
        "children": [
            {
                "type": "string_literal",
                "value": "test-value"
            },
            {
                "type": "string_literal",
                "value": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AstAndOperatorNodeInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
