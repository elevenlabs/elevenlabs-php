<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StudioAgentSettingsModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_settings": {
            "key": {
                "skip_confirmation": true
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\StudioAgentSettingsModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
