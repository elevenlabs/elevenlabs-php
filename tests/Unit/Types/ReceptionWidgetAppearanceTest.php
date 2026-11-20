<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionWidgetAppearanceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "orb_color_1": "test-value",
        "orb_color_2": "test-value",
        "variant": "tiny",
        "placement": "top-left",
        "dismissible": true,
        "main_label": "test-value",
        "start_call": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionWidgetAppearance::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
