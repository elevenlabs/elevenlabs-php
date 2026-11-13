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
class BuiltInToolsWorkflowOverrideInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The transfer to agent tool
   */
  #[JsonProperty('transfer_to_agent')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $transferToAgent;

  /**
   * The end call tool
   */
  #[JsonProperty('end_call')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $endCall;

  /**
   * The language detection tool
   */
  #[JsonProperty('language_detection')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $languageDetection;

  /**
   * The transfer to number tool
   */
  #[JsonProperty('transfer_to_number')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $transferToNumber;

  /**
   * The skip turn tool
   */
  #[JsonProperty('skip_turn')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $skipTurn;

  /**
   * The play DTMF tool
   */
  #[JsonProperty('play_keypad_touch_tone')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $playKeypadTouchTone;

  /**
   * The voicemail detection tool
   */
  #[JsonProperty('voicemail_detection')]
  public ?\ElevenLabs\Types\SystemToolConfigInput $voicemailDetection;

  /**
   * @param array{
   *   transferToAgent?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   endCall?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   languageDetection?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   transferToNumber?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   skipTurn?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   playKeypadTouchTone?: ?\ElevenLabs\Types\SystemToolConfigInput,
   *   voicemailDetection?: ?\ElevenLabs\Types\SystemToolConfigInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->transferToAgent = $values['transferToAgent'] ?? null;
    $this->endCall = $values['endCall'] ?? null;
    $this->languageDetection = $values['languageDetection'] ?? null;
    $this->transferToNumber = $values['transferToNumber'] ?? null;
    $this->skipTurn = $values['skipTurn'] ?? null;
    $this->playKeypadTouchTone = $values['playKeypadTouchTone'] ?? null;
    $this->voicemailDetection = $values['voicemailDetection'] ?? null;

    if (array_key_exists('transferToAgent', $values)) {
      $this->_dirtyFields['transfer_to_agent'] = true;
    }
    if (array_key_exists('endCall', $values)) {
      $this->_dirtyFields['end_call'] = true;
    }
    if (array_key_exists('languageDetection', $values)) {
      $this->_dirtyFields['language_detection'] = true;
    }
    if (array_key_exists('transferToNumber', $values)) {
      $this->_dirtyFields['transfer_to_number'] = true;
    }
    if (array_key_exists('skipTurn', $values)) {
      $this->_dirtyFields['skip_turn'] = true;
    }
    if (array_key_exists('playKeypadTouchTone', $values)) {
      $this->_dirtyFields['play_keypad_touch_tone'] = true;
    }
    if (array_key_exists('voicemailDetection', $values)) {
      $this->_dirtyFields['voicemail_detection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->transferToAgent !== null) {
      $parts[] = [
        'name' => 'transfer_to_agent',
        'contents' => json_encode($this->transferToAgent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->endCall !== null) {
      $parts[] = [
        'name' => 'end_call',
        'contents' => json_encode($this->endCall),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->languageDetection !== null) {
      $parts[] = [
        'name' => 'language_detection',
        'contents' => json_encode($this->languageDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transferToNumber !== null) {
      $parts[] = [
        'name' => 'transfer_to_number',
        'contents' => json_encode($this->transferToNumber),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->skipTurn !== null) {
      $parts[] = [
        'name' => 'skip_turn',
        'contents' => json_encode($this->skipTurn),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->playKeypadTouchTone !== null) {
      $parts[] = [
        'name' => 'play_keypad_touch_tone',
        'contents' => json_encode($this->playKeypadTouchTone),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->voicemailDetection !== null) {
      $parts[] = [
        'name' => 'voicemail_detection',
        'contents' => json_encode($this->voicemailDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->transferToAgent?->validate();
    $this->endCall?->validate();
    $this->languageDetection?->validate();
    $this->transferToNumber?->validate();
    $this->skipTurn?->validate();
    $this->playKeypadTouchTone?->validate();
    $this->voicemailDetection?->validate();
  }
}
