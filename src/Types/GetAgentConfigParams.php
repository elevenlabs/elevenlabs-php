<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Return the full editable config of a single receptionist, including the
 * current ``additional_instructions`` text.
 *
 * ``list_customer_facing_agents`` is intentionally lightweight (metadata and a
 * truncated greeting preview) and omits ``additional_instructions``. Call this
 * tool whenever you need the current full text before calling
 * ``update_agent_config`` on ``first_message`` or ``additional_instructions``
 * so you can preserve what is already there.
 *
 * Also returns the read-only call-handling settings the owner edits in the
 * app: ``staff_answers_first`` (whether the staff phone rings before the
 * receptionist, the staff phone number, the maximum ring time, the staff
 * hours per day with their timezone, and whether those hours cover the
 * current time), ``turn_eagerness`` (response speed: eager / normal /
 * patient), ``background_voice_detection`` (filter background speech on/off),
 * ``tool_call_sound`` (hold sound; null means off) and
 * ``enable_play_keypad_touch_tone_tool`` (allow touch tones). Call it to
 * answer what any of these are currently set to, or to check the setup when
 * the owner says calls are not reaching the staff phone.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GetAgentConfigParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetAgentConfigParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\GetAgentConfigParamsSmbToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'get_agent_config';

    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
