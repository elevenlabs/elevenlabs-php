<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CanvasPlacementTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "x_relative": 1,
        "y_relative": 1,
        "scale_x": 1,
        "scale_y": 1,
        "pivot_x": 1,
        "pivot_y": 1,
        "skew_x": 1,
        "skew_y": 1,
        "crop_top": 1,
        "crop_right": 1,
        "crop_bottom": 1,
        "crop_left": 1,
        "flip_x": true,
        "flip_y": true
    }
    JSON;

    $instance = \ElevenLabs\Types\CanvasPlacement::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
