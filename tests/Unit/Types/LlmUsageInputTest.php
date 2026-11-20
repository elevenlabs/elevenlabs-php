<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmUsageInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model_usage": {
            "key": {
                "input": {
                    "tokens": 1,
                    "price": 1
                },
                "input_cache_read": {
                    "tokens": 1,
                    "price": 1
                },
                "input_cache_write": {
                    "tokens": 1,
                    "price": 1
                },
                "output_total": {
                    "tokens": 1,
                    "price": 1
                }
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmUsageInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
