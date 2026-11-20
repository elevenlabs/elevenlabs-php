<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RequiredConstraintsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "any_of": [
            {
                "required": [
                    "test-value"
                ]
            }
        ],
        "all_of": [
            {
                "required": [
                    "test-value"
                ]
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\RequiredConstraints::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
