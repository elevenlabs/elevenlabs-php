<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AstOrOperatorNodeOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "or_operator",
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

    $instance = \ElevenLabs\Types\AstOrOperatorNodeOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
