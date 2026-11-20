<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WidgetStylesTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "base": "test-value",
        "base_hover": "test-value",
        "base_active": "test-value",
        "base_border": "test-value",
        "base_subtle": "test-value",
        "base_primary": "test-value",
        "base_error": "test-value",
        "accent": "test-value",
        "accent_hover": "test-value",
        "accent_active": "test-value",
        "accent_border": "test-value",
        "accent_subtle": "test-value",
        "accent_primary": "test-value",
        "overlay_padding": 1,
        "button_radius": 1,
        "input_radius": 1,
        "bubble_radius": 1,
        "sheet_radius": 1,
        "compact_sheet_radius": 1,
        "dropdown_sheet_radius": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\WidgetStyles::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
