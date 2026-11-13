<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Allows the agent to play DTMF tones during a phone call.
 *
 * This tool can be used to interact with automated phone systems, such as
 * navigating phone menus, entering extensions, or inputting numeric codes.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PlayDtmfToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PlayDtmfToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * Send DTMF tones as out-of-band RTP events (RFC 4733) instead of in-band audio. Only effective for SIP trunk imported numbers.
   */
  #[JsonProperty('use_out_of_band_dtmf')]
  public ?bool $useOutOfBandDtmf;

  /**
   * If true, the agent will not generate further speech after playing DTMF tones. This prevents the agent's speech from interfering with IVR systems.
   */
  #[JsonProperty('suppress_turn_after_dtmf')]
  public ?bool $suppressTurnAfterDtmf;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\PlayDtmfToolConfigSystemToolType>,
   *   useOutOfBandDtmf?: ?bool,
   *   suppressTurnAfterDtmf?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'play_keypad_touch_tone';
    $this->useOutOfBandDtmf = $values['useOutOfBandDtmf'] ?? null;
    $this->suppressTurnAfterDtmf = $values['suppressTurnAfterDtmf'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('useOutOfBandDtmf', $values)) {
      $this->_dirtyFields['use_out_of_band_dtmf'] = true;
    }
    if (array_key_exists('suppressTurnAfterDtmf', $values)) {
      $this->_dirtyFields['suppress_turn_after_dtmf'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->systemToolType !== null) {
      $parts[] = [
        'name' => 'system_tool_type',
        'contents' => $this->systemToolType
      ];
    }

    if ($this->useOutOfBandDtmf !== null) {
      $parts[] = [
        'name' => 'use_out_of_band_dtmf',
        'contents' => $this->useOutOfBandDtmf ? 'true' : 'false'
      ];
    }

    if ($this->suppressTurnAfterDtmf !== null) {
      $parts[] = [
        'name' => 'suppress_turn_after_dtmf',
        'contents' => $this->suppressTurnAfterDtmf ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
