<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SfxSourceContextTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_type": "sfx",
        "sound_generation_history_item_id": "test-value",
        "text": "test-value",
        "generation_config": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SfxSourceContext::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
