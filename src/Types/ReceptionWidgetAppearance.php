<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * How the website widget looks. A null label follows the receptionist's language.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionWidgetAppearance extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * First color of the widget's orb gradient, as a hex color.
   */
  #[JsonProperty('orb_color_1', required: true)]
  public string $orbColor1;

  /**
   * Second color of the widget's orb gradient, as a hex color.
   */
  #[JsonProperty('orb_color_2', required: true)]
  public string $orbColor2;

  /**
   * @var value-of<\ElevenLabs\Types\ReceptionWidgetAppearanceVariant>
   * Widget size, from the smallest ('tiny') to the largest ('full').
   */
  #[JsonProperty('variant', required: true)]
  public string $variant;

  /**
   * @var value-of<\ElevenLabs\Types\ReceptionWidgetAppearancePlacement>
   * Where on the page the widget sits.
   */
  #[JsonProperty('placement', required: true)]
  public string $placement;

  /**
   * Whether visitors can close the widget.
   */
  #[JsonProperty('dismissible', required: true)]
  public bool $dismissible;

  /**
   * Text shown on the widget; null uses the default for the receptionist's language.
   */
  #[JsonProperty('main_label')]
  public ?string $mainLabel;

  /**
   * Text on the button that starts a call; null uses the default for the receptionist's language.
   */
  #[JsonProperty('start_call')]
  public ?string $startCall;

  /**
   * @param array{
   *   orbColor1: string,
   *   orbColor2: string,
   *   variant: value-of<\ElevenLabs\Types\ReceptionWidgetAppearanceVariant>,
   *   placement: value-of<\ElevenLabs\Types\ReceptionWidgetAppearancePlacement>,
   *   dismissible: bool,
   *   mainLabel?: ?string,
   *   startCall?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->orbColor1 = $values['orbColor1'];
    $this->orbColor2 = $values['orbColor2'];
    $this->variant = $values['variant'];
    $this->placement = $values['placement'];
    $this->dismissible = $values['dismissible'];
    $this->mainLabel = $values['mainLabel'] ?? null;
    $this->startCall = $values['startCall'] ?? null;

    $this->_dirtyFields = [
      'orb_color_1' => true,
      'orb_color_2' => true,
      'variant' => true,
      'placement' => true,
      'dismissible' => true
    ];
    if (array_key_exists('mainLabel', $values)) {
      $this->_dirtyFields['main_label'] = true;
    }
    if (array_key_exists('startCall', $values)) {
      $this->_dirtyFields['start_call'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'orb_color_1',
      'contents' => $this->orbColor1
    ];

    $parts[] = [
      'name' => 'orb_color_2',
      'contents' => $this->orbColor2
    ];

    $parts[] = [
      'name' => 'variant',
      'contents' => $this->variant
    ];

    $parts[] = [
      'name' => 'placement',
      'contents' => $this->placement
    ];

    $parts[] = [
      'name' => 'dismissible',
      'contents' => $this->dismissible ? 'true' : 'false'
    ];

    if ($this->mainLabel !== null) {
      $parts[] = [
        'name' => 'main_label',
        'contents' => $this->mainLabel
      ];
    }

    if ($this->startCall !== null) {
      $parts[] = [
        'name' => 'start_call',
        'contents' => $this->startCall
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->orbColor1,
      'orb_color_1',
      pattern: '^#(?:[0-9a-fA-F]{3}|[0-9a-fA-F]{6})$'
    );
    Validator::validateString(
      $this->orbColor2,
      'orb_color_2',
      pattern: '^#(?:[0-9a-fA-F]{3}|[0-9a-fA-F]{6})$'
    );
    Validator::validateString($this->mainLabel, 'main_label', maxLength: 100);
    Validator::validateString($this->startCall, 'start_call', maxLength: 100);
  }
}
