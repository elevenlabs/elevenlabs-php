<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmDeprecationConfigModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "warning_start_days": 1,
        "fallback_start_days": 1,
        "fallback_complete_days": 1,
        "fallback_start_percentage": 1,
        "fallback_complete_percentage": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmDeprecationConfigModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
