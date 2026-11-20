<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CompactionSettingsWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "soft_trigger_fraction": 1,
        "tail_size": 1,
        "min_reclaimable_tokens": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\CompactionSettingsWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
