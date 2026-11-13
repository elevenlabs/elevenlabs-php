<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CaptionStyleModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('template')]
  public ?\ElevenLabs\Types\CaptionStyleTemplateModel $template;

  #[JsonProperty('text_font')]
  public ?string $textFont;

  #[JsonProperty('text_scale')]
  public ?float $textScale;

  #[JsonProperty('text_color')]
  public ?string $textColor;

  /**
   * @var ?value-of<\ElevenLabs\Types\CaptionStyleModelTextAlign>
   */
  #[JsonProperty('text_align')]
  public ?string $textAlign;

  /**
   * @var ?value-of<\ElevenLabs\Types\CaptionStyleModelTextStyle>
   */
  #[JsonProperty('text_style')]
  public ?string $textStyle;

  /**
   * @var ?value-of<\ElevenLabs\Types\CaptionStyleModelTextWeight>
   */
  #[JsonProperty('text_weight')]
  public ?string $textWeight;

  /**
   * @var ?value-of<\ElevenLabs\Types\CaptionStyleModelTextTransform>
   */
  #[JsonProperty('text_transform')]
  public ?string $textTransform;

  /**
   * @var ?value-of<\ElevenLabs\Types\CaptionStyleModelTextBlendMode>
   */
  #[JsonProperty('text_blend_mode')]
  public ?string $textBlendMode;

  #[JsonProperty('text_shadow')]
  public ?\ElevenLabs\Types\StudioTextStyleShadowModel $textShadow;

  #[JsonProperty('text_outline')]
  public ?\ElevenLabs\Types\StudioTextStyleOutlineModel $textOutline;

  #[JsonProperty('background_enabled')]
  public ?bool $backgroundEnabled;

  #[JsonProperty('background_color')]
  public ?string $backgroundColor;

  #[JsonProperty('background_opacity')]
  public ?float $backgroundOpacity;

  #[JsonProperty('background_blur')]
  public ?float $backgroundBlur;

  #[JsonProperty('background_border_radius')]
  public ?float $backgroundBorderRadius;

  #[JsonProperty('word_highlights_enabled')]
  public ?bool $wordHighlightsEnabled;

  #[JsonProperty('word_highlights_color')]
  public ?string $wordHighlightsColor;

  #[JsonProperty('word_highlights_background_color')]
  public ?string $wordHighlightsBackgroundColor;

  #[JsonProperty('word_highlights_opacity')]
  public ?float $wordHighlightsOpacity;

  #[JsonProperty('word_highlights_border_radius')]
  public ?float $wordHighlightsBorderRadius;

  #[JsonProperty('word_highlights_blur')]
  public ?float $wordHighlightsBlur;

  #[JsonProperty('section_animation')]
  public ?\ElevenLabs\Types\CaptionStyleSectionAnimationModel $sectionAnimation;

  #[JsonProperty('word_animation')]
  public ?\ElevenLabs\Types\CaptionStyleWordAnimationModel $wordAnimation;

  #[JsonProperty('character_animation')]
  public ?\ElevenLabs\Types\CaptionStyleCharacterAnimationModel $characterAnimation;

  #[JsonProperty('cursor_enabled')]
  public ?bool $cursorEnabled;

  #[JsonProperty('width_pct')]
  public ?float $widthPct;

  #[JsonProperty('horizontal_placement')]
  public ?\ElevenLabs\Types\CaptionStyleHorizontalPlacementModel $horizontalPlacement;

  #[JsonProperty('vertical_placement')]
  public ?\ElevenLabs\Types\CaptionStyleVerticalPlacementModel $verticalPlacement;

  #[JsonProperty('auto_break_enabled')]
  public ?bool $autoBreakEnabled;

  #[JsonProperty('max_lines_per_section')]
  public ?int $maxLinesPerSection;

  #[JsonProperty('max_words_per_line')]
  public ?int $maxWordsPerLine;

  /**
   * @param array{
   *   template?: ?\ElevenLabs\Types\CaptionStyleTemplateModel,
   *   textFont?: ?string,
   *   textScale?: ?float,
   *   textColor?: ?string,
   *   textAlign?: ?value-of<\ElevenLabs\Types\CaptionStyleModelTextAlign>,
   *   textStyle?: ?value-of<\ElevenLabs\Types\CaptionStyleModelTextStyle>,
   *   textWeight?: ?value-of<\ElevenLabs\Types\CaptionStyleModelTextWeight>,
   *   textTransform?: ?value-of<\ElevenLabs\Types\CaptionStyleModelTextTransform>,
   *   textBlendMode?: ?value-of<\ElevenLabs\Types\CaptionStyleModelTextBlendMode>,
   *   textShadow?: ?\ElevenLabs\Types\StudioTextStyleShadowModel,
   *   textOutline?: ?\ElevenLabs\Types\StudioTextStyleOutlineModel,
   *   backgroundEnabled?: ?bool,
   *   backgroundColor?: ?string,
   *   backgroundOpacity?: ?float,
   *   backgroundBlur?: ?float,
   *   backgroundBorderRadius?: ?float,
   *   wordHighlightsEnabled?: ?bool,
   *   wordHighlightsColor?: ?string,
   *   wordHighlightsBackgroundColor?: ?string,
   *   wordHighlightsOpacity?: ?float,
   *   wordHighlightsBorderRadius?: ?float,
   *   wordHighlightsBlur?: ?float,
   *   sectionAnimation?: ?\ElevenLabs\Types\CaptionStyleSectionAnimationModel,
   *   wordAnimation?: ?\ElevenLabs\Types\CaptionStyleWordAnimationModel,
   *   characterAnimation?: ?\ElevenLabs\Types\CaptionStyleCharacterAnimationModel,
   *   cursorEnabled?: ?bool,
   *   widthPct?: ?float,
   *   horizontalPlacement?: ?\ElevenLabs\Types\CaptionStyleHorizontalPlacementModel,
   *   verticalPlacement?: ?\ElevenLabs\Types\CaptionStyleVerticalPlacementModel,
   *   autoBreakEnabled?: ?bool,
   *   maxLinesPerSection?: ?int,
   *   maxWordsPerLine?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->template = $values['template'] ?? null;
    $this->textFont = $values['textFont'] ?? null;
    $this->textScale = $values['textScale'] ?? null;
    $this->textColor = $values['textColor'] ?? null;
    $this->textAlign = $values['textAlign'] ?? null;
    $this->textStyle = $values['textStyle'] ?? null;
    $this->textWeight = $values['textWeight'] ?? null;
    $this->textTransform = $values['textTransform'] ?? null;
    $this->textBlendMode = $values['textBlendMode'] ?? null;
    $this->textShadow = $values['textShadow'] ?? null;
    $this->textOutline = $values['textOutline'] ?? null;
    $this->backgroundEnabled = $values['backgroundEnabled'] ?? null;
    $this->backgroundColor = $values['backgroundColor'] ?? null;
    $this->backgroundOpacity = $values['backgroundOpacity'] ?? null;
    $this->backgroundBlur = $values['backgroundBlur'] ?? null;
    $this->backgroundBorderRadius = $values['backgroundBorderRadius'] ?? null;
    $this->wordHighlightsEnabled = $values['wordHighlightsEnabled'] ?? null;
    $this->wordHighlightsColor = $values['wordHighlightsColor'] ?? null;
    $this->wordHighlightsBackgroundColor = $values['wordHighlightsBackgroundColor'] ?? null;
    $this->wordHighlightsOpacity = $values['wordHighlightsOpacity'] ?? null;
    $this->wordHighlightsBorderRadius = $values['wordHighlightsBorderRadius'] ?? null;
    $this->wordHighlightsBlur = $values['wordHighlightsBlur'] ?? null;
    $this->sectionAnimation = $values['sectionAnimation'] ?? null;
    $this->wordAnimation = $values['wordAnimation'] ?? null;
    $this->characterAnimation = $values['characterAnimation'] ?? null;
    $this->cursorEnabled = $values['cursorEnabled'] ?? null;
    $this->widthPct = $values['widthPct'] ?? null;
    $this->horizontalPlacement = $values['horizontalPlacement'] ?? null;
    $this->verticalPlacement = $values['verticalPlacement'] ?? null;
    $this->autoBreakEnabled = $values['autoBreakEnabled'] ?? null;
    $this->maxLinesPerSection = $values['maxLinesPerSection'] ?? null;
    $this->maxWordsPerLine = $values['maxWordsPerLine'] ?? null;

    if (array_key_exists('template', $values)) {
      $this->_dirtyFields['template'] = true;
    }
    if (array_key_exists('textFont', $values)) {
      $this->_dirtyFields['text_font'] = true;
    }
    if (array_key_exists('textScale', $values)) {
      $this->_dirtyFields['text_scale'] = true;
    }
    if (array_key_exists('textColor', $values)) {
      $this->_dirtyFields['text_color'] = true;
    }
    if (array_key_exists('textAlign', $values)) {
      $this->_dirtyFields['text_align'] = true;
    }
    if (array_key_exists('textStyle', $values)) {
      $this->_dirtyFields['text_style'] = true;
    }
    if (array_key_exists('textWeight', $values)) {
      $this->_dirtyFields['text_weight'] = true;
    }
    if (array_key_exists('textTransform', $values)) {
      $this->_dirtyFields['text_transform'] = true;
    }
    if (array_key_exists('textBlendMode', $values)) {
      $this->_dirtyFields['text_blend_mode'] = true;
    }
    if (array_key_exists('textShadow', $values)) {
      $this->_dirtyFields['text_shadow'] = true;
    }
    if (array_key_exists('textOutline', $values)) {
      $this->_dirtyFields['text_outline'] = true;
    }
    if (array_key_exists('backgroundEnabled', $values)) {
      $this->_dirtyFields['background_enabled'] = true;
    }
    if (array_key_exists('backgroundColor', $values)) {
      $this->_dirtyFields['background_color'] = true;
    }
    if (array_key_exists('backgroundOpacity', $values)) {
      $this->_dirtyFields['background_opacity'] = true;
    }
    if (array_key_exists('backgroundBlur', $values)) {
      $this->_dirtyFields['background_blur'] = true;
    }
    if (array_key_exists('backgroundBorderRadius', $values)) {
      $this->_dirtyFields['background_border_radius'] = true;
    }
    if (array_key_exists('wordHighlightsEnabled', $values)) {
      $this->_dirtyFields['word_highlights_enabled'] = true;
    }
    if (array_key_exists('wordHighlightsColor', $values)) {
      $this->_dirtyFields['word_highlights_color'] = true;
    }
    if (array_key_exists('wordHighlightsBackgroundColor', $values)) {
      $this->_dirtyFields['word_highlights_background_color'] = true;
    }
    if (array_key_exists('wordHighlightsOpacity', $values)) {
      $this->_dirtyFields['word_highlights_opacity'] = true;
    }
    if (array_key_exists('wordHighlightsBorderRadius', $values)) {
      $this->_dirtyFields['word_highlights_border_radius'] = true;
    }
    if (array_key_exists('wordHighlightsBlur', $values)) {
      $this->_dirtyFields['word_highlights_blur'] = true;
    }
    if (array_key_exists('sectionAnimation', $values)) {
      $this->_dirtyFields['section_animation'] = true;
    }
    if (array_key_exists('wordAnimation', $values)) {
      $this->_dirtyFields['word_animation'] = true;
    }
    if (array_key_exists('characterAnimation', $values)) {
      $this->_dirtyFields['character_animation'] = true;
    }
    if (array_key_exists('cursorEnabled', $values)) {
      $this->_dirtyFields['cursor_enabled'] = true;
    }
    if (array_key_exists('widthPct', $values)) {
      $this->_dirtyFields['width_pct'] = true;
    }
    if (array_key_exists('horizontalPlacement', $values)) {
      $this->_dirtyFields['horizontal_placement'] = true;
    }
    if (array_key_exists('verticalPlacement', $values)) {
      $this->_dirtyFields['vertical_placement'] = true;
    }
    if (array_key_exists('autoBreakEnabled', $values)) {
      $this->_dirtyFields['auto_break_enabled'] = true;
    }
    if (array_key_exists('maxLinesPerSection', $values)) {
      $this->_dirtyFields['max_lines_per_section'] = true;
    }
    if (array_key_exists('maxWordsPerLine', $values)) {
      $this->_dirtyFields['max_words_per_line'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->template !== null) {
      $parts[] = [
        'name' => 'template',
        'contents' => json_encode($this->template),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->textFont !== null) {
      $parts[] = [
        'name' => 'text_font',
        'contents' => $this->textFont
      ];
    }

    if ($this->textScale !== null) {
      $parts[] = [
        'name' => 'text_scale',
        'contents' => (string) $this->textScale
      ];
    }

    if ($this->textColor !== null) {
      $parts[] = [
        'name' => 'text_color',
        'contents' => $this->textColor
      ];
    }

    if ($this->textAlign !== null) {
      $parts[] = [
        'name' => 'text_align',
        'contents' => $this->textAlign
      ];
    }

    if ($this->textStyle !== null) {
      $parts[] = [
        'name' => 'text_style',
        'contents' => $this->textStyle
      ];
    }

    if ($this->textWeight !== null) {
      $parts[] = [
        'name' => 'text_weight',
        'contents' => $this->textWeight
      ];
    }

    if ($this->textTransform !== null) {
      $parts[] = [
        'name' => 'text_transform',
        'contents' => $this->textTransform
      ];
    }

    if ($this->textBlendMode !== null) {
      $parts[] = [
        'name' => 'text_blend_mode',
        'contents' => $this->textBlendMode
      ];
    }

    if ($this->textShadow !== null) {
      $parts[] = [
        'name' => 'text_shadow',
        'contents' => json_encode($this->textShadow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->textOutline !== null) {
      $parts[] = [
        'name' => 'text_outline',
        'contents' => json_encode($this->textOutline),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->backgroundEnabled !== null) {
      $parts[] = [
        'name' => 'background_enabled',
        'contents' => $this->backgroundEnabled ? 'true' : 'false'
      ];
    }

    if ($this->backgroundColor !== null) {
      $parts[] = [
        'name' => 'background_color',
        'contents' => $this->backgroundColor
      ];
    }

    if ($this->backgroundOpacity !== null) {
      $parts[] = [
        'name' => 'background_opacity',
        'contents' => (string) $this->backgroundOpacity
      ];
    }

    if ($this->backgroundBlur !== null) {
      $parts[] = [
        'name' => 'background_blur',
        'contents' => (string) $this->backgroundBlur
      ];
    }

    if ($this->backgroundBorderRadius !== null) {
      $parts[] = [
        'name' => 'background_border_radius',
        'contents' => (string) $this->backgroundBorderRadius
      ];
    }

    if ($this->wordHighlightsEnabled !== null) {
      $parts[] = [
        'name' => 'word_highlights_enabled',
        'contents' => $this->wordHighlightsEnabled ? 'true' : 'false'
      ];
    }

    if ($this->wordHighlightsColor !== null) {
      $parts[] = [
        'name' => 'word_highlights_color',
        'contents' => $this->wordHighlightsColor
      ];
    }

    if ($this->wordHighlightsBackgroundColor !== null) {
      $parts[] = [
        'name' => 'word_highlights_background_color',
        'contents' => $this->wordHighlightsBackgroundColor
      ];
    }

    if ($this->wordHighlightsOpacity !== null) {
      $parts[] = [
        'name' => 'word_highlights_opacity',
        'contents' => (string) $this->wordHighlightsOpacity
      ];
    }

    if ($this->wordHighlightsBorderRadius !== null) {
      $parts[] = [
        'name' => 'word_highlights_border_radius',
        'contents' => (string) $this->wordHighlightsBorderRadius
      ];
    }

    if ($this->wordHighlightsBlur !== null) {
      $parts[] = [
        'name' => 'word_highlights_blur',
        'contents' => (string) $this->wordHighlightsBlur
      ];
    }

    if ($this->sectionAnimation !== null) {
      $parts[] = [
        'name' => 'section_animation',
        'contents' => json_encode($this->sectionAnimation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->wordAnimation !== null) {
      $parts[] = [
        'name' => 'word_animation',
        'contents' => json_encode($this->wordAnimation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->characterAnimation !== null) {
      $parts[] = [
        'name' => 'character_animation',
        'contents' => json_encode($this->characterAnimation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->cursorEnabled !== null) {
      $parts[] = [
        'name' => 'cursor_enabled',
        'contents' => $this->cursorEnabled ? 'true' : 'false'
      ];
    }

    if ($this->widthPct !== null) {
      $parts[] = [
        'name' => 'width_pct',
        'contents' => (string) $this->widthPct
      ];
    }

    if ($this->horizontalPlacement !== null) {
      $parts[] = [
        'name' => 'horizontal_placement',
        'contents' => json_encode($this->horizontalPlacement),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->verticalPlacement !== null) {
      $parts[] = [
        'name' => 'vertical_placement',
        'contents' => json_encode($this->verticalPlacement),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->autoBreakEnabled !== null) {
      $parts[] = [
        'name' => 'auto_break_enabled',
        'contents' => $this->autoBreakEnabled ? 'true' : 'false'
      ];
    }

    if ($this->maxLinesPerSection !== null) {
      $parts[] = [
        'name' => 'max_lines_per_section',
        'contents' => (string) $this->maxLinesPerSection
      ];
    }

    if ($this->maxWordsPerLine !== null) {
      $parts[] = [
        'name' => 'max_words_per_line',
        'contents' => (string) $this->maxWordsPerLine
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->template?->validate();
    $this->textShadow?->validate();
    $this->textOutline?->validate();
    $this->sectionAnimation?->validate();
    $this->wordAnimation?->validate();
    $this->characterAnimation?->validate();
    $this->horizontalPlacement?->validate();
    $this->verticalPlacement?->validate();
  }
}
