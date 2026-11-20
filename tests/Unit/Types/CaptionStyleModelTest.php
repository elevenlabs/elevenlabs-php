<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CaptionStyleModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "template": {
            "key": "test-value",
            "label": "test-value",
            "requires_high_fps": true
        },
        "text_font": "test-value",
        "text_scale": 1,
        "text_color": "test-value",
        "text_align": "start",
        "text_style": "normal",
        "text_weight": "normal",
        "text_transform": "none",
        "text_blend_mode": "normal",
        "text_shadow": {
            "enabled": true,
            "color": "test-value",
            "opacity": 1,
            "blur": 1,
            "offset_x": 1,
            "offset_y": 1
        },
        "text_outline": {
            "enabled": true,
            "color": "test-value",
            "opacity": 1,
            "width": 1
        },
        "background_enabled": true,
        "background_color": "test-value",
        "background_opacity": 1,
        "background_blur": 1,
        "background_border_radius": 1,
        "word_highlights_enabled": true,
        "word_highlights_color": "test-value",
        "word_highlights_background_color": "test-value",
        "word_highlights_opacity": 1,
        "word_highlights_border_radius": 1,
        "word_highlights_blur": 1,
        "section_animation": {
            "enter_type": "none",
            "exit_type": "none"
        },
        "word_animation": {
            "enter_type": "none",
            "exit_type": "none"
        },
        "character_animation": {
            "enter_type": "none",
            "exit_type": "none"
        },
        "cursor_enabled": true,
        "width_pct": 1,
        "horizontal_placement": {
            "align": "left",
            "translate_pct": 1
        },
        "vertical_placement": {
            "align": "top",
            "translate_pct": 1
        },
        "auto_break_enabled": true,
        "max_lines_per_section": 1,
        "max_words_per_line": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\CaptionStyleModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
