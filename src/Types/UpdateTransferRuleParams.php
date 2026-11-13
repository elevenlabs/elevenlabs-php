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
class UpdateTransferRuleParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateTransferRuleParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * Whether to offer the post_dial_digits parameter, set from the receptionists' enable_play_keypad_touch_tone_tool config. Digits saved while that is off are dropped when the receptionist is built, so the parameter is hidden rather than accepted and ignored.
   */
  #[JsonProperty('post_dial_digits_enabled')]
  public ?bool $postDialDigitsEnabled;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\UpdateTransferRuleParamsSmbToolType>,
   *   postDialDigitsEnabled?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'update_transfer_rule';
    $this->postDialDigitsEnabled = $values['postDialDigitsEnabled'] ?? null;

    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
    if (array_key_exists('postDialDigitsEnabled', $values)) {
      $this->_dirtyFields['post_dial_digits_enabled'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->smbToolType !== null) {
      $parts[] = [
        'name' => 'smb_tool_type',
        'contents' => $this->smbToolType
      ];
    }

    if ($this->postDialDigitsEnabled !== null) {
      $parts[] = [
        'name' => 'post_dial_digits_enabled',
        'contents' => $this->postDialDigitsEnabled ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
