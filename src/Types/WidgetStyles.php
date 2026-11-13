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
class WidgetStyles extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The base background color.
   */
  #[JsonProperty('base')]
  public ?string $base;

  /**
   * The color of the base background when hovered.
   */
  #[JsonProperty('base_hover')]
  public ?string $baseHover;

  /**
   * The color of the base background when active (clicked).
   */
  #[JsonProperty('base_active')]
  public ?string $baseActive;

  /**
   * The color of the border against the base background.
   */
  #[JsonProperty('base_border')]
  public ?string $baseBorder;

  /**
   * The color of subtle text against the base background.
   */
  #[JsonProperty('base_subtle')]
  public ?string $baseSubtle;

  /**
   * The color of primary text against the base background.
   */
  #[JsonProperty('base_primary')]
  public ?string $basePrimary;

  /**
   * The color of error text against the base background.
   */
  #[JsonProperty('base_error')]
  public ?string $baseError;

  /**
   * The accent background color.
   */
  #[JsonProperty('accent')]
  public ?string $accent;

  /**
   * The color of the accent background when hovered.
   */
  #[JsonProperty('accent_hover')]
  public ?string $accentHover;

  /**
   * The color of the accent background when active (clicked).
   */
  #[JsonProperty('accent_active')]
  public ?string $accentActive;

  /**
   * The color of the border against the accent background.
   */
  #[JsonProperty('accent_border')]
  public ?string $accentBorder;

  /**
   * The color of subtle text against the accent background.
   */
  #[JsonProperty('accent_subtle')]
  public ?string $accentSubtle;

  /**
   * The color of primary text against the accent background.
   */
  #[JsonProperty('accent_primary')]
  public ?string $accentPrimary;

  /**
   * The padding around the edges of the viewport.
   */
  #[JsonProperty('overlay_padding')]
  public ?float $overlayPadding;

  /**
   * The radius of the buttons.
   */
  #[JsonProperty('button_radius')]
  public ?float $buttonRadius;

  /**
   * The radius of the input fields.
   */
  #[JsonProperty('input_radius')]
  public ?float $inputRadius;

  /**
   * The radius of the chat bubbles.
   */
  #[JsonProperty('bubble_radius')]
  public ?float $bubbleRadius;

  /**
   * The default radius of sheets.
   */
  #[JsonProperty('sheet_radius')]
  public ?float $sheetRadius;

  /**
   * The radius of the sheet in compact mode.
   */
  #[JsonProperty('compact_sheet_radius')]
  public ?float $compactSheetRadius;

  /**
   * The radius of the dropdown sheet.
   */
  #[JsonProperty('dropdown_sheet_radius')]
  public ?float $dropdownSheetRadius;

  /**
   * @param array{
   *   base?: ?string,
   *   baseHover?: ?string,
   *   baseActive?: ?string,
   *   baseBorder?: ?string,
   *   baseSubtle?: ?string,
   *   basePrimary?: ?string,
   *   baseError?: ?string,
   *   accent?: ?string,
   *   accentHover?: ?string,
   *   accentActive?: ?string,
   *   accentBorder?: ?string,
   *   accentSubtle?: ?string,
   *   accentPrimary?: ?string,
   *   overlayPadding?: ?float,
   *   buttonRadius?: ?float,
   *   inputRadius?: ?float,
   *   bubbleRadius?: ?float,
   *   sheetRadius?: ?float,
   *   compactSheetRadius?: ?float,
   *   dropdownSheetRadius?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->base = $values['base'] ?? null;
    $this->baseHover = $values['baseHover'] ?? null;
    $this->baseActive = $values['baseActive'] ?? null;
    $this->baseBorder = $values['baseBorder'] ?? null;
    $this->baseSubtle = $values['baseSubtle'] ?? null;
    $this->basePrimary = $values['basePrimary'] ?? null;
    $this->baseError = $values['baseError'] ?? null;
    $this->accent = $values['accent'] ?? null;
    $this->accentHover = $values['accentHover'] ?? null;
    $this->accentActive = $values['accentActive'] ?? null;
    $this->accentBorder = $values['accentBorder'] ?? null;
    $this->accentSubtle = $values['accentSubtle'] ?? null;
    $this->accentPrimary = $values['accentPrimary'] ?? null;
    $this->overlayPadding = $values['overlayPadding'] ?? null;
    $this->buttonRadius = $values['buttonRadius'] ?? null;
    $this->inputRadius = $values['inputRadius'] ?? null;
    $this->bubbleRadius = $values['bubbleRadius'] ?? null;
    $this->sheetRadius = $values['sheetRadius'] ?? null;
    $this->compactSheetRadius = $values['compactSheetRadius'] ?? null;
    $this->dropdownSheetRadius = $values['dropdownSheetRadius'] ?? null;

    if (array_key_exists('base', $values)) {
      $this->_dirtyFields['base'] = true;
    }
    if (array_key_exists('baseHover', $values)) {
      $this->_dirtyFields['base_hover'] = true;
    }
    if (array_key_exists('baseActive', $values)) {
      $this->_dirtyFields['base_active'] = true;
    }
    if (array_key_exists('baseBorder', $values)) {
      $this->_dirtyFields['base_border'] = true;
    }
    if (array_key_exists('baseSubtle', $values)) {
      $this->_dirtyFields['base_subtle'] = true;
    }
    if (array_key_exists('basePrimary', $values)) {
      $this->_dirtyFields['base_primary'] = true;
    }
    if (array_key_exists('baseError', $values)) {
      $this->_dirtyFields['base_error'] = true;
    }
    if (array_key_exists('accent', $values)) {
      $this->_dirtyFields['accent'] = true;
    }
    if (array_key_exists('accentHover', $values)) {
      $this->_dirtyFields['accent_hover'] = true;
    }
    if (array_key_exists('accentActive', $values)) {
      $this->_dirtyFields['accent_active'] = true;
    }
    if (array_key_exists('accentBorder', $values)) {
      $this->_dirtyFields['accent_border'] = true;
    }
    if (array_key_exists('accentSubtle', $values)) {
      $this->_dirtyFields['accent_subtle'] = true;
    }
    if (array_key_exists('accentPrimary', $values)) {
      $this->_dirtyFields['accent_primary'] = true;
    }
    if (array_key_exists('overlayPadding', $values)) {
      $this->_dirtyFields['overlay_padding'] = true;
    }
    if (array_key_exists('buttonRadius', $values)) {
      $this->_dirtyFields['button_radius'] = true;
    }
    if (array_key_exists('inputRadius', $values)) {
      $this->_dirtyFields['input_radius'] = true;
    }
    if (array_key_exists('bubbleRadius', $values)) {
      $this->_dirtyFields['bubble_radius'] = true;
    }
    if (array_key_exists('sheetRadius', $values)) {
      $this->_dirtyFields['sheet_radius'] = true;
    }
    if (array_key_exists('compactSheetRadius', $values)) {
      $this->_dirtyFields['compact_sheet_radius'] = true;
    }
    if (array_key_exists('dropdownSheetRadius', $values)) {
      $this->_dirtyFields['dropdown_sheet_radius'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->base !== null) {
      $parts[] = [
        'name' => 'base',
        'contents' => $this->base
      ];
    }

    if ($this->baseHover !== null) {
      $parts[] = [
        'name' => 'base_hover',
        'contents' => $this->baseHover
      ];
    }

    if ($this->baseActive !== null) {
      $parts[] = [
        'name' => 'base_active',
        'contents' => $this->baseActive
      ];
    }

    if ($this->baseBorder !== null) {
      $parts[] = [
        'name' => 'base_border',
        'contents' => $this->baseBorder
      ];
    }

    if ($this->baseSubtle !== null) {
      $parts[] = [
        'name' => 'base_subtle',
        'contents' => $this->baseSubtle
      ];
    }

    if ($this->basePrimary !== null) {
      $parts[] = [
        'name' => 'base_primary',
        'contents' => $this->basePrimary
      ];
    }

    if ($this->baseError !== null) {
      $parts[] = [
        'name' => 'base_error',
        'contents' => $this->baseError
      ];
    }

    if ($this->accent !== null) {
      $parts[] = [
        'name' => 'accent',
        'contents' => $this->accent
      ];
    }

    if ($this->accentHover !== null) {
      $parts[] = [
        'name' => 'accent_hover',
        'contents' => $this->accentHover
      ];
    }

    if ($this->accentActive !== null) {
      $parts[] = [
        'name' => 'accent_active',
        'contents' => $this->accentActive
      ];
    }

    if ($this->accentBorder !== null) {
      $parts[] = [
        'name' => 'accent_border',
        'contents' => $this->accentBorder
      ];
    }

    if ($this->accentSubtle !== null) {
      $parts[] = [
        'name' => 'accent_subtle',
        'contents' => $this->accentSubtle
      ];
    }

    if ($this->accentPrimary !== null) {
      $parts[] = [
        'name' => 'accent_primary',
        'contents' => $this->accentPrimary
      ];
    }

    if ($this->overlayPadding !== null) {
      $parts[] = [
        'name' => 'overlay_padding',
        'contents' => (string) $this->overlayPadding
      ];
    }

    if ($this->buttonRadius !== null) {
      $parts[] = [
        'name' => 'button_radius',
        'contents' => (string) $this->buttonRadius
      ];
    }

    if ($this->inputRadius !== null) {
      $parts[] = [
        'name' => 'input_radius',
        'contents' => (string) $this->inputRadius
      ];
    }

    if ($this->bubbleRadius !== null) {
      $parts[] = [
        'name' => 'bubble_radius',
        'contents' => (string) $this->bubbleRadius
      ];
    }

    if ($this->sheetRadius !== null) {
      $parts[] = [
        'name' => 'sheet_radius',
        'contents' => (string) $this->sheetRadius
      ];
    }

    if ($this->compactSheetRadius !== null) {
      $parts[] = [
        'name' => 'compact_sheet_radius',
        'contents' => (string) $this->compactSheetRadius
      ];
    }

    if ($this->dropdownSheetRadius !== null) {
      $parts[] = [
        'name' => 'dropdown_sheet_radius',
        'contents' => (string) $this->dropdownSheetRadius
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
