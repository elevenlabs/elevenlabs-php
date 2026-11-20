<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StudioTextStyleShadowModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "color": "test-value",
        "opacity": 1,
        "blur": 1,
        "offset_x": 1,
        "offset_y": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\StudioTextStyleShadowModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
